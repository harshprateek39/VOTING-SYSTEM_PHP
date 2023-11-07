
<?php
session_start();
if(!isset($_SESSION['userdata'])){
    header("location: ../");
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupsdata'];
if($_SESSION['userdata']['status'] == 0){
    $status = '<b style="color : red">Not voted </b>';
}
else{
    $status = '<b style="color :green">Voted </b>';
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online voting system</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<style>
    .btn {
        padding: 10px;
        border-radius: 8px;
        background-color: green;
        border: none;
        width: 8%;
        cursor: pointer;
        color: white;
        font-size: 15px;
        margin-top: 15px;
    }

    #backbtn {
        float: left;
    }

    #logoutbtn {
        float: right;
    }

    #profile {
        width: 400px;
        float: left;
        background-color: white;
        margin-left: 15px;
        padding: 20px;
    }

    .profile-info {
        display: flex;
        justify-content: center;
        line-height: 1.6;
    }

    #group {
        width: 800px;
        float: right;
        background-color: white;
        margin-right: 15px;
        padding: 20px;
    }

    .group-item {
        display: flex;
        justify-content: space-around;
    }

    .group-image {
        float: right;
        margin-left : 300px;
    }

    .group-details {
        flex: left;
        justify-content: center;

        line-height: 1.6;
    }

    .vote-btn {
        margin-top: 10px;
        width : 100px;
    }
    #voted{
        padding: 10px;
        border-radius: 8px;
        background-color: coral;
        border: none;
        cursor: pointer;
        color: white;
        font-size: 15px;
        margin-top: 15px;
        width : 100px
    }
</style>
<div id="mainSection">
    <div id="headerSection">
    <a href="../">  <button id="backbtn" class="btn"> Back</button></a>
    <a href="logout.php"><button id="logoutbtn" class="btn"> Logout</button></a>
        <h1>Online Voting System</h1>
    </div>
    <hr>
    <div id="profile">
        <img src="../uploads/<?php echo $userdata['photo']?>" height="150px" width="150px"> <br><br>
        <div class="profile-info">
            <div>
                <b>Name:</b>
                <br>
                <b>Mobile:</b>
                <br>
                <b>Address:</b>
                <br>
                <b>Status:</b>
            </div>
            <div>
                <?php echo $userdata['Name'] ?>
                <br>
                <?php echo $userdata['mobile'] ?>
                <br>
                <?php echo $userdata['address'] ?>
                <br>
                <?php echo $status ?>
            </div>
        </div>
    </div>
    <div id="group">
        <?php
        if ($_SESSION['groupsdata']) {
            for ($i = 0; $i < count($groupsdata); $i++) {
                ?>
                <div class="group-item">
                    <div class="group-details">
                       <div> 
                       <b>Group Name: </b><?php echo $groupsdata[$i]['Name'] ?><br>
                       </div>
                       <div>
                        <b>Votes: </b><?php echo $groupsdata[$i]['votes'] ?><br>
                        </div>
                        <div>
                        <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                            <?php 
                            if($_SESSION['userdata']['status'] == 0){
                                ?>
                            <input type="submit" name="votebtn" value="Vote" class="vote-btn btn">

                                <?php
                            }
                            else{
                                ?>
                            <button disabled type="submit" name="votebtn" value="Vote" id = "voted" >Voted</button>

                                <?php
                            }
                            ?>
                        </form>
                        </div>
                    </div>
                    <img class="group-image" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" width="100px" height="100px"><br><br>
                </div>
                <hr>
                <?php
            }
        }
        ?>
    </div>
</div>
    </body>
    </html>