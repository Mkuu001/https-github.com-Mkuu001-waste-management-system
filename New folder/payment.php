<?php

// Get the payment data from the request.
$paymentData = json_decode(file_get_contents('php://input'));

// Validate the payment data.
if (!isset($paymentData->paymentMethod) || !in_array($paymentData->paymentMethod, ['mpesa', 'credit_card'])) {
  die('Invalid payment method.');
}

if ($paymentData->paymentMethod == 'mpesa') {
  if (!isset($paymentData->mpesaPhoneNumber) || !is_numeric($paymentData->mpesaPhoneNumber)) {
    die('Invalid M-Pesa phone number.');
  }
} else if ($paymentData->paymentMethod == 'credit_card') {
  if (!isset($paymentData->creditCardNumber) || !preg_match('/^[0-9]{16}$/', $paymentData->creditCardNumber)) {
    die('Invalid credit card number.');
  }

  if (!isset($paymentData->creditCardExpirationDate) || !preg_match('/^(0[1-9]|1[0-2])\/([2-9]\d{1})$/', $paymentData->creditCardExpirationDate)) {
    die('Invalid credit card expiration date.');
  }

  if (!isset($paymentData->creditCardCVV) || !preg_match('/^\d{3}$/', $paymentData->creditCardCVV)) {
    die('Invalid credit card CVV.');
  }
}

// Process the payment.
if ($paymentData->paymentMethod == 'mpesa') {
  // Initiate the M-Pesa payment.
  $mpesaResult = initiateMpesaPayment($paymentData->mpesaPhoneNumber);

  if ($mpesaResult['success']) {
    // Payment successful.
    echo json_encode([
      'success' => true,
      'message' => 'Payment successful.'
    ]);
  } else {
    // Payment failed.
    echo json_encode([
      'success' => false,
      'message' => $mpesaResult['message']
    ]);
  }
} else if ($paymentData->paymentMethod == 'credit_card') {
  // Initiate the credit card payment.
  $creditCardResult = initiateCreditCardPayment($paymentData->creditCardNumber, $paymentData->creditCardExpirationDate, $paymentData->creditCardCVV);

  if ($creditCardResult['success']) {
    // Payment successful.
    echo json_encode([
      'success' => true,
      'message' => 'Payment successful.'
    ]);
  } else {
    // Payment failed.
    echo json_encode([
      'success' => false,
      'message' => $creditCardResult['message']
    ]);
  }
}

?>
