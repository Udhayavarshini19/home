<?php
session_start();
include_once './include/header.php';
include_once "./scripts/DB.php";


if (!isset($_SESSION['user']->contact)) {
    header('Location: userlogin.php');
    exit();
}

$contact = $_SESSION['user']->contact;

// Fetch pending bookings
$pendingBookings = DB::query("SELECT * FROM bookings WHERE contact = ? AND status = 'pending'", [$contact]);

// Fetch accepted bookings
$acceptedBookings = DB::query("SELECT * FROM bookings WHERE contact = ? AND status = 'accepted'", [$contact]);

// Fetch denied bookings
$deniedBookings = DB::query("SELECT * FROM bookings WHERE contact = ? AND status = 'denied'", [$contact]);

// Fetch completed bookings
$completedBookings = DB::query("SELECT * FROM bookings WHERE contact = ? AND status = 'finished'", [$contact]);

if ($pendingBookings === null || $acceptedBookings === null || $deniedBookings === null || $completedBookings === null) {
    echo "<p>Error retrieving bookings. Please try again later.</p>";
    exit();
}
?>

<div class="container">
    <h2>Dashboard</h2>
    
    <!-- Pending Bookings -->
    <h3>Pending Bookings</h3>
    <?php if ($pendingBookings->rowCount() > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Provider Contact</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Problem</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $pendingBookings->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking->provider_id); ?></td>
                        <td><?= htmlspecialchars($booking->adder); ?></td>
                        <td><?= htmlspecialchars($booking->date); ?></td>
                        <td><?= htmlspecialchars($booking->queries); ?></td>
                        <td><?= htmlspecialchars($booking->status); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No pending bookings.</p>
    <?php endif; ?>
    
    <!-- Denied Bookings -->
    <h3>Denied Bookings</h3>
    <?php if ($deniedBookings->rowCount() > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Provider Contact</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Problem</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $deniedBookings->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking->provider_id); ?></td>
                        <td><?= htmlspecialchars($booking->adder); ?></td>
                        <td><?= htmlspecialchars($booking->date); ?></td>
                        <td><?= htmlspecialchars($booking->queries); ?></td>
                        <td><?= htmlspecialchars($booking->status); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No denied bookings.</p>
    <?php endif; ?>
    
    <!-- Completed Bookings -->
    <h3>Completed Bookings</h3>
    <?php if ($completedBookings->rowCount() > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Provider Contact</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Problem</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $completedBookings->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking->provider_id); ?></td>
                        <td><?= htmlspecialchars($booking->adder); ?></td>
                        <td><?= htmlspecialchars($booking->date); ?></td>
                        <td><?= htmlspecialchars($booking->queries); ?></td>
                        <td><?= htmlspecialchars($booking->status); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No completed bookings.</p>
    <?php endif; ?>
</div>
