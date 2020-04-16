import 'package:flutter/material.dart';
import 'package:material_design_icons_flutter/material_design_icons_flutter.dart';

class StudioTab extends StatefulWidget {
  @override
  _StudioTabState createState() => _StudioTabState();
}

class _StudioTabState extends State<StudioTab> {
  @override
  Widget build(BuildContext context) {
    return Container(
      child: Icon(MdiIcons.accountCircle,
    ));
  }
}