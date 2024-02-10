import 'dart:convert';
import 'package:http/http.dart' as http;

class UserProfileUpdate {
  static Future<void> changePassword(String email, String newPassword) async {
    var url = Uri.parse('https://example.com/change_password.php'); // Update with your actual URL
    var response = await http.post(
      url,
      body: {
        'email': email,
        'new_password': newPassword,
      },
    );

    if (response.statusCode == 200) {
      var data = jsonDecode(response.body);
      if (data['status'] == 'success') {
        print('Password change successful');
      } else {
        print('Password change failed');
      }
    } else {
      print('HTTP request failed');
    }
  }
}
