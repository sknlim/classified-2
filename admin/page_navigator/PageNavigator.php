<?php

/**
  *	@author Michele Castellucci <castellucci@cottonbit.it>
  */

/** 
 *	Questa classe consente di gestire la visualizzazione in pagine di un set di elementi.  
 *  La navigazione funziona tramite due argomenti $_GET, e mantiene ad ogni 
 *  variazione di pagina (o di risultati per pagina) tutti gli argomenti $_GET esistenti.
 *  E' possibile creare un sistema di navigazione sulle pagine molto simile a quello di Google, 
 *  oppure semplice (combo box). */		
class PageNavigator
{

	/**  Il numero di risultati per pagina.
	  *  @see PageNavigator()
	  *  @var int */ 
	var $results_per_page=5;
	
	/**  Il numero di risultati per pagina iniziale.
	  *  @see PageNavigator(),show_RPP_browsing()
	  *  @var int */ 	
	var $ORIGINAL_results_per_page=5;
	
	/**  Query string contenente altri eventuali parametri GET gia' esistenti 
	  *  @see PageNavigator()
	  *  @var string */ 	
	var $query_string="";

	/**  Classe del foglio di stile da applicare alle select 
	  *  @see PageNavigator()
	  *  @var string */ 	
	var $style="class=\"";
	
	/**  Il numero totale di elementi di cui creare la paginazione 
	  *  @see PageNavigator()
	  *  @var int */ 	
	var $rowsNum;
	
	/**  Ancora HTML da usare per il passaggio tra' le varie pagine 
	  *  @see PageNavigator()
	  *  @var string */	
	var $anchor;

	/**  Nome dell'istanza del navigatore. Usato come suffisso per i GET usati 
	  *  @see PageNavigator()
	  *  @var string */		
	var $name="";

	/**  Numero di pagine calcolato 
	  *  @see PageNavigator()
	  *  @var int */		
	var $pages=0;
	
	
	/**  Numero di select input stampate per la navigazione sulle pagine
	  *  Serve per dare un id univoco alla select, l'id serve per le label (vedi XHTML e accessibilita')
	  *  @see show_page_browsing()
	  *  @var int */		
	var $select_page_count=1;

	/**  Numero di select input stampate per la selezione di risultati per pagina
	  *  Serve per dare un id univoco alla select, l'id serve per le label (vedi XHTML e accessibilita')
	  *  @see show_RPP_browsing()
	  *  @var int */		
	var $select_rpp_count=1;
	/**  Contiene i testi nella lingua utilizzata
	  *  
	  *  @see show_RPP_browsing()
	  *  @var int */		
	
	var $lang=array();
	
	function setLanguage($lang)
	{
		$lang=strtolower($lang);		
		$this->lang['languageName']=$lang;

		if ($lang=='english')
		{
			$this->lang['rpp']="results per page";
			$this->lang['goPage']="go on page";
			$this->lang['previousPage']="Previous Page";
			$this->lang['nextPage']="Next Page";
			$this->lang['page']="page";
		}else
		{
			$this->lang['rpp']="risultati per pagina";
			$this->lang['goPage']="vai alla pagina";
			$this->lang['previousPage']="Pagina precedente";
			$this->lang['nextPage']="Pagina successiva";
			$this->lang['page']="pagina";
		}
	}
	
	/** Costruttore della classe: 
	  * $rowsNum (numero di righe) e' il parametro fondamentale il numero di elementi TOTALE da visualizzare. 
	  * $anchor è il nome dell'ancora dei collegamenti generati per il cambio di pagina o di risultati per pagina 
	  * (infatti queste operazioni implicano il ricaricamento della pagina).
	  * $result_per_page e' autoesplicativo.
	  * $name è un nome utile nel qual caso si utilizzassero due PageNavigator sulla stessa pagina. Infatti $name viene usato come suffisso per i nomi dei parametri $_GET.
	  * 
	  *  @param int $rowsNum Il numero totale di elementi di cui creare la paginazione 
	  *  @param string $anchor Ancora HTML da usare per il passaggio tra' le varie pagine 
	  *  @param string $style Classe del foglio di stile da applicare alle select 
	  *  @param int $results_per_page Il numero di risultati per pagina.
	  *  @param string $name */           	
	
	function PageNavigator($rowsNum,$anchor="",$style="",$results_per_page=5,$name="")
	{
		$this->name=$name;
		$this->realName=str_replace("_"," ",ucfirst($name));
		$this->page=isset($_GET['Page_'.$this->name])?$_GET['Page_'.$this->name]:0;
		$this->anchor=$anchor;
		$this->rowsNum=$rowsNum;		
		$this->style=$style==""?"":"class=\"$style\"";
		
		$this->ORIGINAL_results_per_page=$results_per_page;		
		$this->results_per_page=isset($_GET['results_per_page_'.$this->name])?$_GET['results_per_page_'.$this->name]:$results_per_page;
		
		$this->pages=ceil($this->rowsNum/$this->results_per_page);
		
		
		$this->query_string=buildQueryString("Page_{$this->name}","results_per_page_{$this->name}");
		
		if ($this->page!=0)  // gestione cambio di risultati per pagina (ex funzione dataseek() )
		{
			//se il numero di elementi è minore dell'elemento di partenza da visualizzare 
			//allora c'è stato un cambio di risultati per pagina....
			while ($this->rowsNum<=($this->page*$this->results_per_page))  
			$this->page--; // ...quindi corregge la variabile page decrementandola			
		}
		$this->setLanguage('italiano');
		
	}
	
	/** restituisce il numero della pagina corrente */
	function getCurrentPage() {return $this->page+1;}
	
	/** restituisce il numero della pagina corrente */
	function getTotalPages() {return $this->pages;}
	
	
	/**  Restituisce una stringa contenente la clausola LIMIT x,x di SQL da aggiungere alla query di selezione dei dati. 
	  *  Questo è molto utile perché con questa clausola, si limita l’estrazione dei dati ad un certo range di valori. 
	  *  Tale range è naturalmente legato alla pagina attualmente selezionata e al numero di risultati per pagina.	  
	  *  @return string */ 	
	function getLimit() //ritorna il costrutto LIMIT da applicare alla query SQL
	{
		$start=$this->page*$this->results_per_page;
		return " LIMIT ".$start.",".$this->results_per_page;
	}	
	
	/** Mostra la navigazione delle pagine in modalità semplice (tramite una semplice combo box) o ‘google like’ a seconda del parametro $googleLike. 
	  * Il parametro $offset è un parametro utile solo in modalità ‘google like’.
	  * La modalità google like prevede una selezione delle pagine attraverso link diretti alle pagine, con un sistema di 
	  * selezione delle pagine molto simile a google.
	  * Il parametro $offset specifica il numero di link (a pagine) visualizzati a sinistra e a destra quando ci si trova ‘in mezzo’ 
	  * ovvero quando la pagina attuale ha un numero di pagine precedenti ed un numero di pagine successive maggiori di offset. 
	  * In parole povere, il numero massimo di link visualizzati in modalità google like è uguale a ($offset*2)+1.
	  *  @param boolean $googleLike 
	  *  @param int $offset 
	  *  @return string */ 	
	function show_page_browsing($googleLike=true,$offset=7)
	{
		$layout="";
	
		if ($this->results_per_page>=$this->rowsNum) return false; //se il numero di elementi non supera il numero di paginazione non mostra la navigazione

			if (file_exists("img/next.gif")) 
			$imagesPath="img/";
			else if (file_exists("classes/next.gif"))
			$imagesPath="classes/";
			else if (file_exists("writein3/classes/next.gif"))
			$imagesPath="writein3/classes/";
			else if (file_exists("next.gif"))
			$imagesPath="";
			
			
			$prev=$this->page-1;
			$next=$this->page+1;
			
			if ($this->page) //se c'è una pagina precedente visualizza la freccia sx 
			$prev_page_arrow= "<a href=\"{$_SERVER['PHP_SELF']}?Page_{$this->name}=$prev&amp;results_per_page_{$this->name}={$this->results_per_page}{$this->query_string}#$this->anchor\">
								 <img style=\"vertical-align:text-bottom;border:none;\" src=\"{$imagesPath}prev.gif\" alt=\"{$this->realName}: {$this->lang['previousPage']}\" title=\"{$this->realName}: {$this->lang['previousPage']}\" /></a><b> [ ";
			else $prev_page_arrow=" <b>[ ";
								
			if ($this->rowsNum>($this->page*$this->results_per_page+$this->results_per_page)) //se c'è una pagina successiva visualizza la frecciaDX
			$next_page_arrow= " ] </b><a href=\"{$_SERVER['PHP_SELF']}?Page_{$this->name}=$next&amp;results_per_page_{$this->name}={$this->results_per_page}{$this->query_string}#$this->anchor\">
					 			 <img style=\"vertical-align:text-bottom;border:none;\" src=\"{$imagesPath}next.gif\" alt=\"{$this->realName}: {$this->lang['nextPage']}\"  title=\"{$this->realName}: {$this->lang['nextPage']}\" /></a>";	  
			else $next_page_arrow=" ]</b> ";		
	
		if ($googleLike)
		{	
	

			$layout.=$prev_page_arrow;
			
			
				//**************************************INDICI PAGINE*********************

				//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°INDICI $j e $start da usare nel ciclo°°°°°°°°°°°°°°°°°°°°°°°°°
				if ($this->page<$offset) 
				{
					$start=$j=0; 
				}
				else //se la pagina è maggiore uguale all'offset gli indici partono dalla pagina corrente meno l'offset
				{
					$start=$j=$this->page-$offset; 
					//$start è l'indice pagina di partenza (dei link)
					//$j è la variabile incrementata usata dal ciclo che conterrà gli indici delle pagine					

					
					if ($this->page>$offset) //puntolini iniziali
					//$layout.= ".<a href=\"{$_SERVER['PHP_SELF']}?Page_{$this->name}=".($j-1)."&amp;results_per_page_{$this->name}={$this->results_per_page}{$this->query_string}#$this->anchor\">";
					$layout.="....";
					//$layout.="</a>. ";

				}
				//°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°°

				
				//esegue il ciclo fino a quando si sono visualizzate il massimo numero di link visualizzabili ($offset*2+1) --->break;
				//oppure fino a che non si sono stampati tutti i link per tutte le pagine (in questo caso il numero totale di pagine è minore di ($offset*2+1) )
				for (;$j<$this->pages;$j++) 
				{
					if ($this->page==$j) //se è la pagina corrente non crea il link 
					{
						$index=$j+1;			
						$page_link[]= "<span style=\"font-size:13px; font-family:verdana, helvetica, arial; color:#222222; font-weight:normal\" title=\"{$this->realName}: pagina $index\"> $index </span>";
					}
					else
					{
						if (($j-$start)<($offset*2+1))//se l'n-esimo indice che si visualizza (j-start)
																// arriva al doppio dell'offset +1 allora si ferma e visualizza ....
																
																//#doppio dell'offset +1# perchè gli indici prima della pagina corrente +
																//gli indici dopo la pagina corrente (offset*2) + l'indice della pag. corrente
						{
							$index=$j+1;
							$page_link[]= "  <a href=\"{$_SERVER['PHP_SELF']}?Page_{$this->name}=$j&amp;results_per_page_{$this->name}={$this->results_per_page}{$this->query_string}#$this->anchor\"
										   	  title=\"{$this->realName}: {$this->lang['page']} $index\"> $index</a> ";

						}
						else //puntolini finali
						{
							//$layout.= " .<a href=\"{$_SERVER['PHP_SELF']}?Page_{$this->name}=$j&amp;results_per_page_{$this->name}={$this->results_per_page}{$this->query_string}#$this->anchor\">";
							$layout.=implode("|",$page_link)."...."; 
							unset($page_link); //evita di rifare l'implode
							//$layout.= "</a>. "; 
							
							break;
						}
					}
				}	
				
			if (isset($page_link)) $layout.=implode("|",$page_link);				
			$layout.=$next_page_arrow;
			
		}else //scelta pagine con select
		{
			if ($this->realName=="") $hdn=""; else $hdn=$this->realName.", ";
			$layout.= "<label for=\"select_page_{$this->name}_number_{$this->select_page_count}\" >{$hdn}{$this->lang['goPage']}</label> ";
						
			$layout.=$prev_page_arrow;
						
			$layout.= " <select $this->style style=\"width:auto\" id=\"select_page_{$this->name}_number_{$this->select_page_count}\" 
			onchange=\"location.href='{$_SERVER['PHP_SELF']}?Page_{$this->name}='+this.value+'&amp;results_per_page_{$this->name}={$this->results_per_page}{$this->query_string}#{$this->anchor}'\">";
			
			for ($i=0;$i<$this->pages;$i++)
			{
				$sel=$this->page==$i?"selected=\"selected\"":"";
				$layout.= "<option value=\"$i\" $sel>".($i+1)."</option>
				";
			}
			$layout.= "</select> ";					
			$layout.=$next_page_arrow;	
			
			$this->select_page_count++;
		
		}
		

		return($layout);  
		
	}	
	
	/** Mostra la navigazione dei risultati per tramite una semplice combo box.
	  * $selections specifica il numero di selezioni possibili.
	  * $interval specifica l’intervallo tra il valore di una selezione e l’altra.
	  * Con i parametri predefiniti avremo 10 selezioni possibili come numero di risultati per pagina, 
	  * la prima avrà valore 5, le successive 9 avranno valori multipli di 5.
	  * Nota: Se il valore dell’argomento $results_per_page passato al costruttore non ha un valore corrispondente ad una delle possibili selezioni di RPP, 
	  * viene aggiunto alla combo box una selezione con tale valore.  
	  *  @param int $selections 
	  *  @param int $interval 
	  *  @return string */ 				
	
	function show_RPP_browsing($selections=10,$interval=5)
	{
			if ($this->realName=="") $hdn=""; else $hdn=$this->realName.", ";
			$temp= "
			<label for=\"results_per_page_{$this->name}_number_{$this->select_rpp_count}\" >{$hdn}{$this->lang['rpp']}</label>
			<select $this->style style=\"width:auto\" id=\"results_per_page_{$this->name}_number_{$this->select_rpp_count}\" 
			onchange=\"location.href='{$_SERVER['PHP_SELF']}?results_per_page_{$this->name}='+this.value+'&amp;Page_{$this->name}={$this->page}{$this->query_string}#{$this->anchor}'\">";
		
			///CODICE PER RILEVARE UN VALORE DI DEFAULT DI RPP NON PREVISTO NEI VALORI POSSIBILI DELLA SELECT 
			for ($i=$interval,$j=0;$j<$selections;$i=$i+$interval,$j++)
			{
				if ($this->ORIGINAL_results_per_page==$i)
				{
					$founded_default_RPP=true;
					break;
				}	
			}
			
			if (!isset($founded_default_RPP))	$temp.= "<option value=\"{$this->ORIGINAL_results_per_page}\" selected=\"selected\">{$this->ORIGINAL_results_per_page}</option>
				";
			////////////////////////////////////////////////////////////////////////////////////////////
		
			for ($i=$interval,$j=0;$j<$selections;$i=$i+$interval,$j++)
			{
				$sel=$this->results_per_page==$i?"selected=\"selected\"":"";
				$temp.= "<option value=\"$i\" $sel>$i</option>
				";
			}
			$temp.= "	</select>
					";
					
			$this->select_rpp_count++;		
			return $temp;
			
	}
	
}

?>