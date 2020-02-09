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
    <title>Songgr</title>
    <?php links() ?>
</head>
<body>
<div id="song-view-wrapper">
    <div id="display">
        <div id="order-by">
            <label>Order by</label>
            <select id="order-by-select">
                <?php
                if(isset($orderby)){
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
                while ($songs[] = $songs_query->fetch_row()) {}
            }
            if ($songs[sizeof($songs) - 1] === null) {
                unset($songs[sizeof($songs) - 1]);
            }

            foreach ($songs as $song) {
                echo '<tr>';
                echo "<td id='$song[1]' class='copy'>$song[1]</td>";
                echo "<td id='$song[2]' class='copy'>$song[2]</td>";
                echo "<td id='$song[3]' class='copy'>$song[3]</td>";
                echo "<td id='$song[4]'>$song[4]</td>";
                echo "<td class='remove' data-song-id='$song[0]'>X</td>";
                echo '</tr>';
            }
            ?>
        </table>
    </div>
    <form id="input-form" class="row" method= "post" action="">
        <?php
        $qartists = 'SELECT DISTINCT artist_name FROM sg_song_table';
        $qalbums = 'SELECT DISTINCT album_name FROM sg_song_table';
        $qsongs = 'SELECT DISTINCT song_name FROM sg_song_table';
        $artists_ = $db->query($qartists);
        $albums_ = $db->query($qalbums);
        $songs_ = $db->query($qsongs);
        while($artists[] = $artists_->fetch_row()[0]){}
        while($albums[] = $albums_->fetch_row()){}
        while($songs_select[] = $songs_->fetch_row()[0]){}
        ?>
        <div class="col-sm-3">
            <input id="artist" type="text" name="artist" placeholder="Artist Name">
            <?php  if(!empty($artists)){
                echo '<select id="select-artist">';
                foreach($artists as $artist){ echo "<option>$artist</option>"; }
                echo '</select>';
            } ?>
        </div>
        <div class="col-sm-3">
            <input id="album" type="text" name="album" placeholder="Album Name">
            <?php  if(!empty($albums)){
                echo '<select id="select-album">';
                foreach($albums as $album){ echo "<option>$album[0]</option>"; }
                echo '</select>';
            } ?>
        </div>
        <div class="col-sm-3">
            <input id="song" type="text" name="song" placeholder="Song Name">
            <?php  if(!empty($songs)){
                echo '<select id="select-song">';
                foreach($songs_select as $song){ echo "<option>$song</option>"; }
                echo '</select>';
            } ?>
        </div>
        <div class="col-sm-3">
            <input type="text" name="link" placeholder="Link">
            <input id="input-form-button" type="submit" name="submit" value="Add">
        </div>
    </form>
</div>
</body>
</html>
