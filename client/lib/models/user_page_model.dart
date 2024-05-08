class UserPageModel {
  final String id;
  final String? username, nome, cognome, telefono, email;

  UserPageModel({
    required this.id,
    this.username,
    this.nome,
    this.cognome,
    this.telefono,
    this.email,
  });

  factory UserPageModel.fromMap(Map<String, dynamic> map) {
    return UserPageModel(
      id: map['id'],
      username: map['username'],
      nome: map['nome'],
      cognome: map['cognome'],
      telefono: map['telefono'],
      email: map['email'],
    );
  }
}