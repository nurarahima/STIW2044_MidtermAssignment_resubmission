// Import the necessary packages
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

// Define a class for the payment screen
class PaymentScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Payment'),
      ),
      body: Center(
        child: ElevatedButton(
          onPressed: () {
            // Simulate payment processing
            _processPayment();
          },
          child: Text('Complete Payment'),
        ),
      ),
    );
  }

  // Simulated payment processing function
  void _processPayment() {
    // Simulate payment processing delay
    Future.delayed(Duration(seconds: 2), () {
      // Show payment success message
      Fluttertoast.showToast(
        msg: 'Payment Successful!',
        toastLength: Toast.LENGTH_SHORT,
        backgroundColor: Colors.green,
        textColor: Colors.white,
      );

      // Navigate back to the previous screen or home screen
      Navigator.pop(context);
    });
  }
}
