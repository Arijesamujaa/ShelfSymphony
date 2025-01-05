<?php
include 'config.php';
session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM `cart` WHERE id = :delete_id");
    $stmt->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: cart.php');
    } else {
        echo 'Query failed';
    }
}

$stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$cart_row_number = $stmt->rowCount();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include('navbar.php');
    ?>
    <section class="py-5" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-lg-7">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
                                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                    $stmt->execute();

                                    if ($stmt->rowCount() > 0) {
                                    ?>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="h5">Shopping Bag</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($fetch_cart = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                        <tr>
                                                            <th scope="row">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="<?= htmlspecialchars($fetch_cart['image']) ?>" class="img-fluid rounded-3"
                                                                        style="width: 120px;" alt="Book">
                                                                    <div class="flex-column ms-4">
                                                                        <p class="mb-2 text-wrap" style="max-width: 200px;"><?= htmlspecialchars($fetch_cart['name']) ?></p>
                                                                    </div>
                                                                </div>
                                                            </th>

                                                            <td class="align-middle">
                                                                <div class="d-flex flex-row">
                                                                    <input id="quantity_<?= $fetch_cart['id'] ?>" min="0" name="quantity" value="1" type="number"
                                                                        class="form-control form-control-sm" style="width: 50px;"
                                                                        onchange="updatePriceCart(<?= $fetch_cart['id'] ?>, <?= $fetch_cart['price'] ?>)" />
                                                                </div>
                                                            </td>
                                                            <td class="align-middle">
                                                                <p class="mb-0" style="font-weight: 500;" id="price_<?= $fetch_cart['id'] ?>"><?= htmlspecialchars($fetch_cart['price']) ?>€</p>
                                                            </td>
                                                            <td class="align-middle">
                                                                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>"
                                                                    onclick="return confirm('Are you sure you want to delete this product from cart');">
                                                                    <img src="images/svg/delete.svg" alt="">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php
                                    } else {
                                        echo '<p class="empty">Your Cart is Empty!</p>';
                                    }
                                    ?>
                                </div>

                                <div class="col-lg-5">
                                    <div class="card bg-dark text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Card details</h5>
                                            </div>

                                            <p class="small mb-2">Card type</p>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-visa fa-2x me-2"></i></a>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-amex fa-2x me-2"></i></a>
                                            <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>

                                            <form class="mt-4">
                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                                        placeholder="Cardholder's Name" />
                                                    <label class="form-label" for="typeName">Cardholder's Name</label>
                                                </div>

                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                                        placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                                    <label class="form-label" for="typeText">Card Number</label>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div data-mdb-input-init class="form-outline form-white">
                                                            <input type="text" id="typeExp" class="form-control form-control-lg"
                                                                placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                                            <label class="form-label" for="typeExp">Expiration</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div data-mdb-input-init class="form-outline form-white">
                                                            <input type="password" id="typeText" class="form-control form-control-lg"
                                                                placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                            <label class="form-label" for="typeText">Cvv</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-4">
                                                <?php
                                                    $total = 0;
                                                    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id = :user_id");
                                                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                                                    $stmt->execute();
                                                    while ($fetch_cart = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        $total += $fetch_cart['price'];
                                                    }
                                                ?>
                                                <p class="mb-2" id="total-price"><?= htmlspecialchars($total) ?>€</p>
                                            </div>

                                            <a href="order.php">
                                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-light btn-lg" style="width: 180px;">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Buy</span>
                                                    </div>
                                                </button>
                                            </a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/cart.js"></script>
</body>

</html>