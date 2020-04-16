import 'package:flutter/material.dart';
import 'package:material_design_icons_flutter/material_design_icons_flutter.dart';

import 'closet_tab.dart';
import 'inspiration_tab.dart';
import 'studio_tab.dart';
class HomePage extends StatefulWidget {
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 3,
      initialIndex: 1,
      child: Scaffold(
          appBar: AppBar(
        title: Text(
          "Close",
          style: TextStyle(fontWeight: FontWeight.bold, color: Colors.grey),
        ),
        centerTitle: false,
        backgroundColor: Colors.white,
        bottom: TabBar(
          indicatorColor: Colors.purple,
          unselectedLabelColor: Colors.grey,
          labelColor: Colors.purple,
          tabs: <Widget>[
          Tab(
            icon: Icon(MdiIcons.hanger,
            ),
          ),
          Tab(
            icon: Icon(MdiIcons.accountCircle,),
          ),
          Tab(
            icon: Icon(MdiIcons.dresserOutline,),
          )
        ],
        ),
        actions: <Widget>[
          IconButton(
            onPressed: () {},
            icon: Icon(MdiIcons.chatOutline,
            color: Colors.grey,)
          ),
          IconButton(
            onPressed: () {},
            icon: Icon(Icons.search,
            color: Colors.grey,),
          ),
          IconButton(
            onPressed: () {},
            icon: Icon(Icons.more_vert, color: Colors.grey,),
          )
        ],
      ),
      body: TabBarView(
        children: <Widget>[
          InspirationTab(),
          StudioTab(),
          ClosetTab(),
        ]
      ),
      ),
    );
  }
}

//alteração de estado
void mudarEstado(Color c){}