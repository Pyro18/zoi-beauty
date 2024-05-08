import 'package:client/models/user_page_model.dart';
import 'package:client/network/api.dart';

class UserController {
  final Api api = Api();

  Future<UserPageModel> fetchUser(String userId) async {
    final userData = await api.getUser(userId);
    print('API response: $userData');
    if (userData['data'] != null) {
      return UserPageModel.fromMap({
        'id': userData['data']['id'].toString(),
        'username': userData['data']['username'],
        'nome': userData['data']['nome'],
        'cognome': userData['data']['cognome'],
        'telefono': userData['data']['telefono'],
        'email': userData['data']['email'],
      });
    } else {
      throw Exception('User data is null');
    }
  }
}
