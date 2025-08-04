<?php
$bookedDates = ["2025-08-05", "2025-08-07", "2025-08-09", "2025-08-11", "2025-08-13", "2025-08-15", "2025-08-17", "2025-08-19", "2025-08-21", "2025-08-23"];

$couponCodes = [
    "WELCOMESTAY" => 20,
    "DISCOUNT20" => 20,
    "BOOKNOW15" => 15,
    "WEEKENDGETAWAY" => 25,
    "SUMMERSPECIAL" => 10,
    "FAMILYDEAL" => 20,
    "ROMANTICESCAPE" => 30,
    "BUSINESSTRIP" => 15,
    "LUXURYSTAY" => 50,
    "LOYALTYREWARD" => 10
];

$meetingRoomPrices = [
    "5 Seater MR" => 300,
    "8 Seater MR" => 500
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meeting Room Booking</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 30px;
            background-color: #f9f9f9;
        }
        .form-container {
            width: 750px;
            background-color: #f2f2f2;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-container h2 {
            text-align: center;
            color: #2a2a86;
            margin-bottom: 25px;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .form-group {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }
        .form-group-full {
            flex: 1 1 100%;
        }
        label {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 600;
        }
        input, select, textarea {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
        }
        button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            width: 150px;
            cursor: pointer;
        }
        .submit-btn {
            flex: 1 1 100%;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        @media (max-width: 600px) {
            .form-group {
                flex: 1 1 100%;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Meeting Rooms - Online Booking</h2>
        <form id="bookingForm">
            <div class="form-group">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" required>
            </div>
            <div class="form-group">
                <label for="company">Company/Organization (Optional)</label>
                <input type="text" id="company">
            </div>
            <div class="form-group">
                <label for="meetingRoom">Pick a Meeting Room</label>
                <select id="meetingRoom" required>
                    <option value="">Pick a Meeting Room</option>
                    <option value="5 Seater MR">5 Seater MR - ₹300</option>
                    <option value="8 Seater MR">8 Seater MR - ₹500</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bookingDate">Date of Booking</label>
                <input type="date" id="bookingDate" required>
            </div>
            <div class="form-group">
                <label for="startTime">Start Time</label>
                <input type="time" id="startTime" required>
            </div>
            <div class="form-group">
                <label for="endTime">End Time</label>
                <input type="time" id="endTime" required>
            </div>
            <div class="form-group">
                <label for="couponCode">Coupon Code (Optional)</label>
                <input type="text" id="couponCode">
            </div>
            <div class="form-group">
                <label for="totalAmount">Total Amount</label>
                <input type="text" id="totalAmount" readonly>
            </div>
            <div class="form-group form-group-full">
                <label for="additionalInfo">Additional Info</label>
                <textarea id="additionalInfo" rows="3"></textarea>
            </div>
            <div class="submit-btn">
                <button type="submit">Book Now</button>
            </div>
        </form>
    </div>

    <script>
        const bookedDates = <?php echo json_encode($bookedDates); ?>;
        const couponCodes = <?php echo json_encode($couponCodes); ?>;
        const roomPrices = <?php echo json_encode($meetingRoomPrices); ?>;

        const form = document.getElementById('bookingForm');
        const meetingRoom = document.getElementById('meetingRoom');
        const couponInput = document.getElementById('couponCode');
        const totalAmount = document.getElementById('totalAmount');
        const bookingDate = document.getElementById('bookingDate');

        function calculateTotal() {
            const room = meetingRoom.value;
            let baseAmount = roomPrices[room] || 0;

            const coupon = couponInput.value.trim().toUpperCase();
            const discount = couponCodes[coupon] || 0;

            const finalAmount = baseAmount - discount;
            totalAmount.value = `₹${finalAmount > 0 ? finalAmount : 0}`;
        }

        meetingRoom.addEventListener('change', calculateTotal);
        couponInput.addEventListener('input', calculateTotal);

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const selectedDate = bookingDate.value;

            if (bookedDates.includes(selectedDate)) {
                alert("Sorry, this date is already booked.");
                return;
            }

            alert("Redirecting to Rupay payment gateway...");
            window.location.href = "https://www.rupay.co.in/";
        });
    </script>
</body>
</html>
