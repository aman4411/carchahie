<?php ?>
<div class="container table-responsive py-5">
    <div class="row">
        <div class="col text-center mt-3">
            <h3>Your Car Rental Orders</h3>
            <p class="text-h3">View all your bookings here</p>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Booking Id</th>
                <th scope="col">Model Name</th>
                <th scope="col">Vehicle Number</th>
                <th scope="col">Capacity</th>
                <th scope="col">Rent/Day</th>
                <th scope="col">Booking Start Date</th>
                <th scope="col">Days Booked For</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($booking = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $booking['bookingId'] ?></td>
                    <td><?php echo $booking['model'] ?></td>
                    <td><?php echo $booking['number'] ?></td>
                    <td><?php echo $booking['capacity'] ?></td>
                    <td><?php echo $booking['rent'] ?></td>
                    <td><?php echo $booking['bookingStartDate'] ?></td>
                    <td><?php echo $booking['bookingDays'] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
