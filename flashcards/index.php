<?php
$the_title = "MathWiz | Flashcards";
$pathcor = "../";
require_once '../view/header.php';
?>
    <link rel="stylesheet" href="../flashcards/style.css" />
  <body>
    <div class="flashcard-box">
    <h1>
      Flash Cards
    </h1>

    <div id="cards-container" class="cards">
    </div>

    <div class="navigation">
      <button id="prev" class="nav-button">
        [Prev]
      </button>

      <p id="current"></p>

      <button id="next" class="nav-button">
        [Next]
      </button>
    </div>
</div>
    <script src="../flashcards/flashcards.js"></script>
  </body>
</html>
