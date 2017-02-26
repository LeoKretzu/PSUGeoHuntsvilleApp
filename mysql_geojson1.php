<?php
/*
 * Title:   MySQL Points to GeoJSON
 * Notes:   Query a MySQL table or view of points with x and y columns and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.
 * Author:  Bryan R. McBride, GISP
 * Contact: bryanmcbride.com
 * GitHub:  https://github.com/bmcbride/PHP-Database-GeoJSON
 */
# Connect to MySQL database
$conn = new PDO('mysql:host=localhost;dbname=huntsville','root','PASSWORD_OBSCURED'); # put pw here 
# Build SQL SELECT statement including x and y columns
$sql = 'SELECT * FROM huntsville';

# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occurred.\n';
    exit;
}
# Build GeoJSON feature collection array
$geojson = array(
   'features'  => array(), 
   'id' => 1000,
   'type' => "FeatureCollection",
   'format' => "",
   'url' => "",
   'subdomains' => "",
   'layer' => "",
   'transparent' => True,
   'layerParams' => "{}",
   'dynamicParams' => "{}",
   'refreshrate' => 0,
   'token' => "",
   'attribution' => "",
   'spatialReference' => "",
   'layerParsingFunction' => "",
   'enableIdentify' => False,
   'rootField' => "",
   'infoFormat' => "",
   'fieldsToShow' => "",
   'description' => "",
   'downloadableLink' => null,
   'layer_info_link' => null,
   'styles' => ""
);
# Loop through rows to build feature arrays
while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
    # Remove x and y fields from properties (optional)
    unset($properties['x']);
    unset($properties['y']);
    $feature = array(
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $row['latitude'],
                $row['longitude']
            )
        ),
        'properties' => $properties
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}
header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);
$conn = NULL;
?>