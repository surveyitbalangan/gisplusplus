<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    
        $query = 
            "SELECT t.table_schema, t.table_name
                from information_schema.tables t
                inner join information_schema.columns c on c.table_name = t.table_name and c.table_schema = t.table_schema
            where c.column_name = 'date' 
               and t.table_schema not in ('information_schema', 'pg_catalog')
                and t.table_type = 'BASE TABLE'
            order by t.table_schema;";

        $db = pg_connect("host=192.168.34.10 port=5432 dbname=database_balangan user=postgres password=postgresdb");
        $result = pg_query($db,$query);

       

        ?>

    
</head>
<body>
    <?php
    
    $row_arr = array();

    while($row=pg_fetch_assoc($result))
    {
        array_push($row_arr, $row['table_name']);
    }      
    


    

    ?>

    <div id="table_list">
        <ul id="ul_list">

        </ul>
    </div>


<script>
    var rows = <?= json_encode($row_arr) ?>;
    console.log(rows)

    var ul_list = document.getElementById("ul_list");
    
    for(i in rows){
        console.log(rows[i]);

        node = document.createElement("li");
        node.innerHTML = rows[i].replace(/_/g, " ");

        ul_list.appendChild(node);
    }

</script>
</body>
</html>