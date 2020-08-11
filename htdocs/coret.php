<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormShp extends CI_Controller {

  public function __construct()
  {
          parent::__construct();
          $this->load->helper(array('form', 'url'));
  }

  public function index()
  {
          $this->load->view('shp/formshp', array('error' => ' ' ));
  }

  public function do_upload()
  {
          $config['upload_path']          = './uploads/';
          $config['allowed_types']        = '*';

          $this->load->library('upload', $config);

          if ( ! $this->upload->do_upload('shp') || ! $this->upload->do_upload('shx') || ! $this->upload->do_upload('dbf'))
          {
                  $error = array('error' => $this->upload->display_errors());

                  $this->load->view('shp/formshp', $error);
          }
          else
          {
                  // $this->upload->do_upload('shp');
                  // $this->upload->do_upload('shx');
                  // $this->upload->do_upload('dbf');
                  // $file1 = $this->upload->data();
                  
                  $data = array('upload_data' => $this->upload->data());

                  $this->load->view('shp/shp', $data);
          }
  }

}


<html>
<head>
<title>Upload Form</title>
<script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('formshp/do_upload');?>
    <h5>shp</h5>
    <input type="file" name="shp" size="20" />
    <h5>shx</h5>
    <input type="file" name="shx" size="20" />
    <h5>dbf</h5>
    <input type="file" name="dbf" size="20" />
    <br /><br />

<input type="submit" value="upload" />

<?
if(isset($upload_data))
{
    var_dump($upload_data);
}

else
{
    //not set
}
?>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

class wkt_object {
    public $id;
    public $shape;

    function set_id($name){
        $this->id = $name;
    }

    function set_shape($shape) {
        $this->$shape = $shape;
    }
}

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$wkt_arr = array();
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    $sql = "SELECT OGR_FID, ST_AsText(SHAPE) FROM polyline";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $wkt_arr[$row["OGR_FID"]] = new wkt_object();
            $wkt_arr[$row["OGR_FID"]]->set_id($row["OGR_FID"]);
            $wkt_arr[$row["OGR_FID"]]->set_shape($row["ST_AsText(SHAPE)"]);
            // echo "id: " . $row["OGR_FID"]. " - Shape: " . $row["ST_AsText(SHAPE)"]."<br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}

// echo json_encode($wkt_arr);
foreach ($wkt_arr as &$item) {
    var_dump($item);
    echo "<br>";
}
?>

</body>
</html>

<?php
class Shp extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper('url_helper');
        }
        
        public function index()
        {
            $data['title'] = 'Welcome To Mapbox';

            $this->load->view('shp/shp', $data);
        }
}

<?

    class GeoJSONObject {
        public $type;
        public $name;
        public $features;

        function __construct($type, $name, $features) {
            $this->type = $type;
            $this->name = $name;
            $this->features = $features;
        }
    }

    $features_arr = [];
    $wkt_arr = [];

    // $data = json_encode($upload_data);
    $origname = $upload_data["orig_name"];
    $nama_arr = (explode(".",$origname));
    $nama_file = $nama_arr[0];
    // echo $data;
    echo "nama file : ".$nama_file."<br><br><br><br><br>";

    require_once('Shapefile/ShapefileAutoloader.php');
    Shapefile\ShapefileAutoloader::register();
  
    use Shapefile\Geometry\Point;
    use Shapefile\Geometry\Linestring;
    use Shapefile\Geometry\Polygon;
    use Shapefile\Shapefile;
    use Shapefile\ShapefileException;
    use Shapefile\ShapefileWriter;
    use Shapefile\ShapefileReader;

    try {
        // Open Shapefile
        $Shapefile = new ShapefileReader('uploads/'.$nama_file, [
            Shapefile::OPTION_SUPPRESS_M            => true,
            Shapefile::OPTION_DBF_NULL_PADDING_CHAR => '*']);

        var_dump($Shapefile);

        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        
        // Read all the records
        while ($Geometry = $Shapefile->fetchRecord()) {
            // Skip the record if marked as "deleted"
            if ($Geometry->isDeleted()) {
                continue;
            }
            
             // Print Geometry as an Array
            // print_r($Geometry->getArray());
            
            // Print Geometry as WKT
            // echo "WKT : ";
            // print_r($Geometry->getWKT());
            array_push($wkt_arr, $Geometry->getWKT());

            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";

            
            // Print Geometry as GeoJSON
            // echo "geojson : ";
            // print_r($Geometry->getGeoJSON());
            array_push($features_arr, $Geometry->getGeoJSON());

            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";

            
            // Print DBF data
            // print_r(json_encode($Geometry->getDataArray()));
        }
    
    } catch (ShapefileException $e) {
        // Print detailed error information
        echo "Error Type: " . $e->getErrorType()
            . "\nMessage: " . $e->getMessage()
            . "\nDetails: " . $e->getDetails();
    }

    $data_uploaded = new GeoJSONObject("FeatureCollection", $nama_file, $features_arr);
    // echo json_encode($data_uploaded);

?>

<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>
<div id='target'></div>
<div id='target2'></div>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('formshp', 'Upload Another File!'); ?></p>
<?= var_dump($upload_data)?>
<?= "<br> Geometri: " ?>
<?= var_dump($Geometry)?>

<script>
window.onload = function() {
    var data = <?echo json_encode($data_uploaded);?>;
    var wkt = <?echo json_encode($wkt_arr)?>;

    target = document.getElementById('target');
    target.innerHTML = data;
    console.log(data);

    target2 = document.getElementById('target2');
    target2.innerHTML = wkt;
    console.log('wkt');
    console.log(wkt);
}


</script>
</body>
</html>

