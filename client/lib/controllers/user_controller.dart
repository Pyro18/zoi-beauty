import 'package:client/network/api.dart';

class UserController {
  final Api api = Api();

  Future<String> getUserName(String userId) async {
    Map<String, dynamic> userData = await api.getUser(userId);
    if (userData['data'] != null) {
      return userData['data']['nome'];
    } else {
      throw Exception('Failed to fetch user name');
    }
  }
}
