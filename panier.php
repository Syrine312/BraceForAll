<?php
session_start();
class Panier {
    private $product = [];
    public function __construct() {
        if (isset($_SESSION['product'])) {
            $this->product = $_SESSION['product'];
        }
    }
    public function ajouter($produit, $price) {
        $this->product[] = ['produit' => $produit, 'price' => $price];
        $_SESSION['product'] = $this->product;
    }
    public function afficher() {
        $output = "";
        if (empty($this->product)) {
            return "<p>Aucun produit dans le panier.</p>";
        }
        foreach ($this->product as $product) {
            $output .= "<p>Produit : <strong>{$product['produit']}</strong>, Prix : <strong>{$product['price']}DT</strong></p>";
        }
        return $output;
    }
    public function vider() {
        $this->product = [];
        $_SESSION['product'] = [];
    }
}
$Panier = new Panier();
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'ajouter') {
        $produit = $_POST['produit'];
        $price = $_POST['price'];
        $Panier->ajouter($produit, $price);
    } elseif ($_POST['action'] === 'vider') {
        $Panier->vider();
    }
}
echo '<a href="attele.html">Retour</a>'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety's key</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(#e0f7e9d5, #e1ecf7d5);
            color: #1e3a8a;
        }
        section#panier {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1e3a8a;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: 2px solid rgba(255,255,255,.5);
        }
        section#panier h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #ffffff;
        }
        #panier-contenu p {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #e0f2fe;
        }
        #total {
            margin-top: 20px;
            font-size: 1.2rem;
            text-align: center;
            color: #ffffff;
        }
        #vider-panier {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            font-size: 1.2rem;
            color: #ffffff;
            background-color: #2563eb;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        #vider-panier:hover {
            background-color: #1e40af;
        }
        #total-prix {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <section id="panier" class="panier">
        <h2>Votre Panier</h2>
        <div id="panier-contenu">
            <?php echo $Panier->afficher(); ?>
        </div>
        <form method="post">
            <input type="hidden" name="action" value="vider">
            <button id="vider-panier">Vider le panier</button>
        </form>
    </section>
</body>
</html>
