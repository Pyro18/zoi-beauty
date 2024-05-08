import 'package:client/models/service_model.dart';
import 'package:client/network/api.dart';

class ServiceController {
  final Api api = Api();

  Future<List<Service>> fetchServices() async {
    final servicesData = await api.getServices();
    return servicesData.map((data) => Service(id: data['id'].toString(), name: data['name'])).toList();
  }
}