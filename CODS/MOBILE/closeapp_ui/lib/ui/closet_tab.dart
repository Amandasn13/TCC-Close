import 'package:flutter/material.dart';
import 'package:material_design_icons_flutter/material_design_icons_flutter.dart';

class ClosetTab extends StatefulWidget {
  @override
  _ClosetTabState createState() => _ClosetTabState();
}

class _ClosetTabState extends State<ClosetTab> {
  @override
  Widget build(BuildContext context) {
    return Container(
      child: Icon(MdiIcons.dresserOutline),
    );
  }
}