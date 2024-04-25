<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadata for the document -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google font (Roboto) inclusion -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- CSS stylesheets for header and main styles -->
    <link rel="stylesheet" href="/src/css/Header.css">
    <link rel="stylesheet" href="/src/css/single-product.css">
    <link rel="stylesheet" href="/src/css/acceuil-style.css">
    <link rel="stylesheet" href="/src/css/single-product.css">
    <title>Détails du produit</title>
</head>
<body>
    <!-- Top navigation bar containing logo, search function, basket icon, and account section -->
    <div class="top-bar">
        <!-- Left section with logo and 'PLAY' text -->
        <div class="left">
            <img id="cy-logo" src="/src/pictures/cy-logo-white.png">
            <p id="cy-play-logo-Text">PLAY</p>
        </div>
        <!-- Center section with search box and button -->
        <div class="center">
            <input id="search-box" type="search" placeholder="Search...">
            <button id="search-button" type="submit">
                <img id="search-icon" src="/src/pictures/icons/search-icon.png" alt="">
            </button>
        </div>
        <!-- Right section with basket button and account information -->
        <div class="right">
            <button class="basket-button">
                &#128722; <!-- Basket icon -->
                <div class="dropdown-content">
                    <!-- <li><span></span></li>
                    <li><span></span></li>
                    <li><span></span></li> -->
                </div>
            </button>
            <div class="account-div">
                <button id="account-button">
                    <img id="profile-picture" src="/src/pictures/icons/profileicon.webp" alt="">
                </button>
                <p id="account-name"></p>
            </div>
        </div>
    </div>

    <!-- Placeholder for horizontal navigation -->
    <nav class="horizontal-nav">
    </nav>

    <!-- Vertical navigation menu with titles -->
    <aside class="vertical-nav">
        <h2 id="h-in-vertical-nav">CY PLAY</h2>
        <h3 id="h-in-vertical-nav">Accueil</h3>
        <div class="left-side">
            <ul id="nav">
                <li class="nav-link">
                    <h1  class="navigation-h1" data-name="acceuil">Home</h1>
                </li>
                <li class="nav-link">
                    <h1 class="navigation-h1" data-name="About">About</h1>
                </li>
                <li class="nav-link">
                    <h1 class="navigation-h1" data-name="contact">contact</h1>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content section -->
    <main>
    <?php
        $product_id = 1/* $_GET['id'] */;
        $mysqli = new mysqli("localhost", "root", "", "cy-play");
        if($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        $sql = "SELECT * FROM product WHERE id = $product_id";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<section id='product-details' class='section-p1'>";
                $sql_images = "SELECT image_url FROM productimages WHERE product_id = $product_id";
                $result_images = $mysqli->query($sql_images);
                $first_image_url = '';
                echo "<div class='single-product-img'>";
                echo "<div class='small-img-group'>";
                if ($result_images->num_rows > 0) {
                    $count = 0;
                    while($row_image = $result_images->fetch_assoc()) {
                        if (empty($first_image_url)) {
                            $first_image_url = $row_image['image_url'];
                        }
                        echo "<div class='small-img-col'>";
                        echo "<img src='".$row_image['image_url']."' width='100%' class='small-img' alt='".$row['name']."' data-index='".$count."'>";
                        echo "</div>";
                        $count++;
                    }
                } else {
                    echo "No images found.";
                }
                echo "</div>";

                if (!empty($first_image_url)) {
                    echo "<img src='".$first_image_url."' width='60%' height='60%' id='MainImg' style=' border: 1px solid #2660aa; border-radius: 5px;' alt='".$row['name']."'>";
                }

                echo "</div>";
                echo "<div class='single-product-details'>";
                echo "<h6>Fournisseur: ".$row['fournisseur']."</h6>";
                echo "<h2 width='100px'>".$row['price']."€</h2>";
                ////Button/////////////////////
                echo "<button><span class='button__text'>Ajouter au panier</span>
                                <span class='button__icon'><svg xmlns='http://www.w3.org/2000/svg' width='24' viewBox='0 0 24 24'
                                stroke-width='2' stroke-linejoin='round' stroke-linecap='round' stroke='currentColor' height='24'
                                fill='none' class='svg'><line y2='19' y1='5' x2='12' x1='12'></line><line y2='12' y1='12' x2='19'
                                x1='5'></line></svg>
                            </span>
                        </button>";
                ////////////////////////////
                echo "<h4>".$row['name']."</h4>";
                echo "<h4>Description du produit :</h4>";
                echo "<span>".$row['description']."</span>";
                echo "<p>Stock: ".$row['stock']."</p>";
                echo "<p>Notes: ".$row['review']."</p>";
                echo "<p>Nombre d'achats: ".$row['nbofachat']."</p>";
                echo "<p>Catégorie: ".$row['categorie']."</p>";
                echo "</div>"; 
                echo "</section>"; 

                $category = $row['categorie'];
                $sql_similar_products = "SELECT * FROM product WHERE categorie = '$category' AND id != $product_id LIMIT 3";
                $result_similar_products = $mysqli->query($sql_similar_products);
                
                if ($result_similar_products->num_rows > 0) {
                    echo "<h2>Produits similaires:</h2>";
                    echo "<div class='similar-products-container'>";
                    while($row_similar_product = $result_similar_products->fetch_assoc()) {
                        echo "<div class='similar-product'>";

                        $similar_product_id = $row_similar_product['id'];
                        $sql_similar_image = "SELECT image_url FROM productimages WHERE product_id = $similar_product_id LIMIT 1";
                        $result_similar_image = $mysqli->query($sql_similar_image);
                        if ($result_similar_image->num_rows > 0) {
                            $row_similar_image = $result_similar_image->fetch_assoc();
                            echo "<a href='product_details.php?id=".$row_similar_product['id']."'><img src='".$row_similar_image['image_url']."' style='display: block; margin-bottom: 10px; width: 300px; height: auto; margin-right: 20px; border: 1px solid #2660aa; border-radius: 5px;' alt='".$row_similar_product['name']."'> </a>";
                        }
                        
                        echo "<p>Prix: ".$row_similar_product['price']."€</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No similar products found.</p>";
                }
            }
        } else {
            echo "Product not found.";
        }
        $mysqli->close();
    ?>
</main>



    <!-- Footer section -->
    <footer>
        <p>Call our service team on 03.22.84.65.74 to place an order</p>
        <p>Copyright © CY Play</p>
        <p>Webmaster CY Tech</p>
    </footer>

    <!-- JavaScript to handle image switching -->
    <script>
        window.onload = function() {
    // Everything is fully loaded now
    const logo = document.getElementById('cy-logo');
    

    if (logo) {
        logo.addEventListener('click', () => {
            window.location.href = '/src/modules/acceuil.html';
        });
    }
  
    const logoText = document.getElementById('cy-play-logo-Text');
    if (logoText) {
        logoText.addEventListener('click', () => {
            window.location.href = '/src/modules/acceuil.html';
        });
    }

    const profpic = document.getElementById('profile-picture');

    if (profpic) {
        profpic.addEventListener('click', () => {
            window.location.href = '/src/modules/signup.html';
        });
    }

    const profname = document.getElementById('account-name');

    if (profname) {
        profname.addEventListener('click', () => {
            window.location.href = '/src/modules/signup.html';
        });
    }

  };
        
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");
        for (var i = 0; i < smallimg.length; i++) {
            smallimg[i].addEventListener("click", function() {
                MainImg.src = this.src;
            });
        }
    </script>
</body>
</html>
