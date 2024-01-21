<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "test";

try {
    $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "DB Connection Failed: " . $e->getMessage();
}

$status = "";
$name = ""; 
$email = "";
$contact = "";
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($message)) {
        $status = "All fields are compulsory.";
    } else {
        if (strlen($name) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $name)) {
            $status = "Please enter a valid name";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $status = "Please enter a valid email";
        } else {
            try {
                $sql = "INSERT INTO feedback (name, email, contact, message) VALUES (:name, :email, :contact, :message)";
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute(['name' => $name, 'email' => $email, 'contact' => $contact, 'message' => $message]);

                $status = "Your message was sent";
                $name = "";
                $email = "";
                $contact = "";
                $message = "";
            } catch (PDOException $e) {
                $status = "Error: " . $e->getMessage();
                echo $status; 
            }
        }
    }
}

?>

<?php include 'header.php'; ?>

<section class="home" id="home">
    <h1>Buy <span>Properties</span></h1>
    <p>Search for the best apartments and house and lots for sale in the Philippines and start accessing your dream home and your next property investment with PropertyAccess Philippines.</p>
    <a href="#properties"><button class="btn">Buy Properties <i class="fas fa-home"></i></button></a>
</section>

<section class="properties" id="properties">
    <h1 class="heading">Buy <span>Properties</span></h1>
    <div class="box-container">
        <div class="box">
            <img src="assets/1.png" alt="">
        </div>
        <div class="details">
            <h3>Belle Vue House</h3>
            <p>Location: Taguig, Metro Manila</p>
            <p>Price: 5,000,000</p>
            <p>Bedrooms: 5</p>
        </div>
        <div class="box">
            <img src="assets/2.jpg" alt="">
        </div>
        <div class="details">
            <h3>Azure Skies Estate</h3>
            <p>Location: Antipolo, Rizal</p>
            <p>Price: 5,000,000</p>
            <p>Bedrooms: 2</p>
        </div>
        <div class="box">
            <img src="assets/3.jpg" alt="">
        </div>
        <div class="details">
            <h3>Amaia House</h3>
            <p>Location: Concepcion, Central Luzon</p>
            <p>Price: 6,000,000</p>
            <p>Bedrooms: 3</p>
        </div>
        <div class="box">
            <img src="assets/4.jpg" alt="">
        </div>
        <div class="details">
            <h3>Chateau House and Lot</h3>
            <p>Location: Looc, Romblon</p>
            <p>Price: 12,300,000</p>
            <p>Bedrooms: 4</p>
        </div>
        <div class="box">
            <img src="assets/5.jpg" alt="">
        </div>
        <div class="details">
            <h3>Lighthouse</h3>
            <p>Location: Lazi, Siquijor</p>
            <p>Price: 3,000,000</p>
            <p>Bedrooms: 4</p>
        </div>
        <div class="box">
            <img src="assets/6.jpg" alt="">
        </div>
        <div class="details">
            <h3>Villa Amour</h3>
            <p>Location: Ramos, Tarlac</p>
            <p>Price: 10,000,000</p>
            <p>Bedrooms: 4</p>
        </div>
        <div class="box">
            <img src="assets/7.jpg" alt="">
        </div>
        <div class="details">
            <h3>Mystic Maple</h3>
            <p>Location: San Felipe, Zambales</p>
            <p>Price: 1,900,000</p>
            <p>Bedrooms: 3</p>
        </div>
        <div class="box">
            <img src="assets/8.jpg" alt="">
        </div>
        <div class="details">
            <h3>Meadowvie House</h3>
            <p>Location: Imus, Cavite</p>
            <p>Price: 12,000,000</p>
            <p>Bedrooms: 5</p>
        </div>
        <div class="box">
            <img src="assets/9.jpg" alt="">
        </div>
        <div class="details">
            <h3>Serendipity Springs</h3>
            <p>Location: Dao, Capiz</p>
            <p>Price: 5,000,000</p>
            <p>Bedrooms: 4</p>
        </div>
        <div class="box">
            <img src="assets/10.jpg" alt="">
        </div>
        <div class="details">
            <h3>Secret Garden Villa</h3>
            <p>Location: President Roxas, Capiz</p>
            <p>Price: 3,000,000</p>
            <p>Bedrooms: 2</p>
        </div>
        <a href="add_properties.php"><button class="btn">Add Properties <i class="fas fa-plus"></i></button></a>
    </div>
</section>

<section class="contact" id="contact">
    <h1 class="heading"><span>Contact </span>Us</h1>
    <div class="row">
        <div class="content">
            <h3 class="title">CONTACT DETAILS</h3>
            <div class="info">
                <h3><i class="fas fa-envelope"></i> realestate@gmail.com</h3>
                <h3><i class="fas fa-phone"></i> 0945-123-4567</h3>
                <h3><i class="fas fa-phone"></i> 0961-234-5678</h3>
            </div>
        </div>
        <form action="" method="post">
            <input type="text" placeholder="Name" class="box" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <input type="email" placeholder="Email" class="box" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <input type="tel" placeholder="Contact Number" class="box" name="contact" value="<?php echo htmlspecialchars($contact); ?>">
            <textarea name="message" cols="30" rows="8" class="box message" placeholder="Message"><?php echo htmlspecialchars($message); ?></textarea>
            <button type="submit" class="btn">Send <i class="fas fa-paper-plane"></i></button>
        </form>
    </div>
</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="script.js"></script>

</body>
</html>