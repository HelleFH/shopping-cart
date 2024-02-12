<style>
    a,
    a:visited {
        text-decoration: none;
        color: inherit;
    }

    .nav_menu {
        list-style: none;
        display: flex;
        justify-content: flex-start;
        padding: 1.5em;
        padding-left: 5%;
        background-color: #c2b5a8;
    }

    .nav_menu li:last-child {
        margin-left: auto;
    }

    .nav_menu li {
        padding-right: 2em;
    }

    .nav_menu li:hover {
        font-weight: 600;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div>
    <nav>
        <ul class="nav_menu">
            <li>
                <a href="index.php">Products</a>
            </li>

            <li>
                <a href="view_cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    View Cart </a>
            </li>
    </nav>
</div>