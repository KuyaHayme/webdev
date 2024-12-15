<?php
include('connect.php');

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    if (isset($_GET['action']) && $_GET['action'] == 'delete') {
        // Delete the booking if action is delete
        $qry = "DELETE FROM booking WHERE booking_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("i", $booking_id);

        if ($stmt->execute()) {
            header("Location: bookings.php?message=Booking deleted successfully");
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif (isset($_GET['status'])) {
        // Update status if action is not delete
        $status = $_GET['status'];
        $qry = "UPDATE booking SET status = ? WHERE booking_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("si", $status, $booking_id);

        if ($stmt->execute()) {
            header("Location: bookings.php?message=Status updated successfully");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid request.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
