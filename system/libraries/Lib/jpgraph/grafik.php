<? 
include ("src/jpgraph.php");    
include ("src/jpgraph_line.php"); 
 
$db = mysql_connect("localhost", "root","") or die(mysql_error()); 
mysql_select_db("grafik",$db) or die(mysql_error()); 
$sql = mysql_query("SELECT * FROM data_grafik") or die(mysql_error());  
 
while($row = mysql_fetch_array($sql)) 
{ 
$data[] = $row[1]; 
$leg[] = $row[0]; 
} 
$kkm = '8';
$graph = new Graph(450,450,"auto"); 
$graph->SetScale('textint'); 
$graph->img->SetMargin(50,30,50,100); 
$graph->SetShadow(); 
$graph->title->Set("Grafik Nilai Siswa"); 
$graph->xaxis->SetTickLabels($leg); 
$graph->xaxis->SetLabelAngle(90);
$graph->xaxis->title->Set("Nama Siswa");
$graph->xaxis->SetTitleSide(SIDE_BOTTOM);
$graph->xaxis->SetTitleMargin(70);
$graph->yaxis->title->Set("Nilai");
$bplot = new LinePlot($data); 
$bplot->value->Show(); 
$bplot->value->SetFont(FF_ARIAL,FS_BOLD); 
//$bplot->value->SetAngle(90); 
//$bplot->SetLegend("Banyak data"); 
 
$graph->Add($bplot); 
$graph->Stroke();  
?>