<?php
// GETでidを取得
$id = $_GET["id"];

// DBに接続
require "funcs.php";
$pdo = db_cct();

// 対象データ取得
$stmt = $pdo->prepare("SELECT * FROM myfilm_db WHERE id=:id");
$stmt ->bindvalue(":id",$id,PDO::PARAM_INT);//PDO::PARAM_STR
$status = $stmt->execute();

//結果をfetch()
if ($status == false) { 
  //SQLエラー関数
  sql_error($stmt);
}else{
  $row = $stmt->fetch();
  
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-2.1.3.min.js"></script>
    <!-- <script src="js/my.js"></script> -->
    <title>Film Review Update</title>
  </head>
  <body>
    <header><h2>Film Review</h2><p>Hollywood blockbusters, local greats, European movies, Japanese and Korean dramas, animation, art house films...all the films you watched</p></header>

    <main>
      <div class="wrap">
      <div id="tmdbsearch">
          <section class="MovieSection">
          Title<input type="search" name="titlesearch" id="titlesearch">
          Year<input type="search" name="year" id="year">
            <input type="button" name="button" id="button" value="Search TMDb">
            <ul class="result" id="result"></ul>
          </section>
      </div>

    <script>
      // TMDbのAPIと連携
      $(function () {
        $("#button").click(function () {
      // タイトルとリリース年で映画データを取得
          const result = $("#titlesearch").val();
          const year = $("#year").val();
          console.log(result,year);

          $.ajax({
            url:
              "https://api.themoviedb.org/3/search/movie?api_key=e160fb82cbbfe85d24559cb058f95a3c&language=en-US&page=1&include_adult=false",
            data: {
              query: result,
              year: year,
            },
          })

          .done(function (data) {
            console.log(data);
            // 配列からタイトル、リリース年、平均スコア、ポスター画像を取得
            data.results.forEach(function(filmlist, index){
              const title = filmlist.title;
              const release_date = filmlist.release_date;
              const vote_average = filmlist.vote_average;
              const posterPath = `https://image.tmdb.org/t/p/w300/${filmlist.poster_path}`;
              console.log(title, release_date, vote_average);
              $("#url").val(posterPath);

              const tablerow = `
              <tr>
                <td class="titles">
                  ${title} TMDB Score: ${vote_average}
                </td>
                <td class="images">
                  <img src="${posterPath}">
                </td>
                                
              </tr>`;
              $("#result").append(tablerow);            
            });
          })

          .fail(function () {
            console.log("$.ajax failed");
          });
        });
      });

      $("#reset").on("click", function () {
        $("#titlesearch").val("");
        $("#year").val("");
        $("#name").val("");
        $("#title").val("");
        $("#date").val("");
        $("#place").val("");
        $("#myscore").val("");
        $("#review").val("");
      });

    </script>
    
      <div id="content">
        <form method="post" action="update.php">
          <div id="qs">
              <label for="name">名前<input type="text" name="name" id="name" value='<?=$row["username"]?>'></label><br>
              <label for="title">タイトル<input type="text" name="title" id="title" value='<?=$row["title"]?>'></label><br>
              <label for="date"></label>観た日<input type="date" name="date" id="date" value='<?=$row["date"]?>'></label><br>
              
              <label for="place">観た場所<select name="place" id="place"><option value="Cinema">Cinema</option><option value="Amazon Prime">Amazon Prime</option><option value="Netflix">Netflix</option><option value="In-Flight">In-Flight</option><option value="Others">Others</option></select></label><br>
              <label for="imdb">TMDb Score<input type="number" name="imdb" id="imdb" step="0.1" value='<?=$row["imdb"]?>'></label><br>
              <label for="myscore">My Score<input type="number" name="myscore" id="myscore" step="0.1" value='<?=$row["myscore"]?>'></label><br>
              <textarea name="review" id="review" cols="80" rows="5" placholder="Review"><?=$row["review"]?></textarea><br>
              <p>Image URL<input type="url" name="url" id="url" size="40" maxlength="120" value='<?=$row["imgurl"]?>'></p>
              <input type="hidden" name="id" value="<?=$row['id']?>">
          </div>
          <div id="submit">
              <input type="reset" id="reset" value="リセット">
              <input type="submit" value="更新">
          </div>
        </form>
      </div>
    </div>
    </main>
    <footer></footer>
  </body>
</html>