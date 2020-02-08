<?php
global $db;
$db = getDB();

# Submit
if (isset($_POST['submit'])) {
    $data = [
        isset($_POST['artist']) ? $db->escape_string($_POST['artist']) : null,
        isset($_POST['album']) ? $db->escape_string($_POST['album']) : null,
        isset($_POST['song']) ? $db->escape_string($_POST['song']) : null,
        isset($_POST['link']) ? $db->escape_string($_POST['link']) : null,
    ];
    if ($data[0] !== '') {
        $query = "insert into sg_song_table (artist_name, album_name, song_name, link) values ('$data[0]', '$data[1]', '$data[2]', '$data[3]');";
        $insert = $db->query($query);
        if ($insert) {
            header('Location: /');
            echo 'Success';
        } else {
            echo 'Failed';
        }
    } else {
        unset($_POST);
    }
}

# Remove
if (isset($_GET['remove'])) {
    if (!empty($_GET['remove'])) {
        $id = $_GET['remove'];
        $query = "UPDATE sg_song_table SET deleted = current_timestamp WHERE id = " . intval($id);
        $remove = $db->query($query);
        if ($remove) {
            header('Location: /');
        } else {
            echo 'Failed';
        }
    }
}

if(isset($_GET['orderby'])){
    $orderby = $_GET['orderby'] . '_name';
}else{
    $orderby = 'artist_name';
}

?>

<html>
<head>
    <?php links() ?>
</head>
<body>
<div id="song-view-wrapper">
    <div id="display">
        <div id="order-by">
            <label>Order by</label>
            <select id="order-by-select">
                <?php
                if(isset($_GET['orderby'])){
                    $list = ['artist', 'album', 'song'];
                    foreach($list as $l){
                        $selected = '';
                        if($_GET['orderby'] == $l){
                            $selected = ' selected';
                        }
                        echo "<option $selected>$l</option>";
                    }
                }
                ?>
            </select>
        </div>
        <table id="display-table">
            <tr>
                <th>artist</th>
                <th>album</th>
                <th>song</th>
                <th>link</th>
            </tr>
            <?php
            $songs_query = $db->query("select * from sg_song_table where deleted is null order by $orderby");
            if ($songs_query) {
                while ($songs[] = $songs_query->fetch_row()) {
                }
            }
            if ($songs[sizeof($songs) - 1] === null) {
                unset($songs[sizeof($songs) - 1]);
            }

            foreach ($songs as $song) {
                echo '<tr>';
                echo "<td>$song[1]</td>";
                echo "<td>$song[2]</td>";
                echo "<td>$song[3]</td>";
                echo "<td>$song[4]</td>";
                echo "<td class='remove' data-song-id='$song[0]'>X</td>";
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <form id="input-form" method="post" action="">
        <input type="text" name="artist" placeholder="Artist Name">
        <input type="text" name="album" placeholder="Album Name">
        <input type="text" name="song" placeholder="Song Name">
        <input type="text" name="link" placeholder="Link">
        <input id="input-form-button" type="submit" name="submit" value="Add">
    </form>
</div>
</body>
</html>
