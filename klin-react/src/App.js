import React from 'react';
import { Router } from '@reach/router';
import Item from './pages/Item.jsx';
import Packet from './pages/Packet.jsx';
import Promo from './pages/Promo.jsx';
import Service from './pages/Service.jsx';
import Users from './pages/Users.jsx';
import Home from './pages/Home.jsx';
import Logout from './pages/Logout.jsx';
import Transaction from './pages/Transaction.jsx';
import ResponsiveNavigation from './component/ResponsiveNavigation.jsx';
import 'bootstrap/dist/css/bootstrap.min.css';
import logo from './logo.svg';
import './App.css';

function App() {
  const navLinks = [
    {
      text: 'Home',
      path: '/',
      icon: 'ion-ios-home'
    },
    {
      text: 'Transaction',
      path: '/transaction',
      icon: 'ion-ios-cash'
    },
    {
      text: 'Packet',
      path: '/packet',
      icon: 'ion-ios-archive'
    },
    {
      text: 'Service',
      path: '/service',
      icon: 'ion-ios-planet'
    },
    {
      text: 'Item',
      path: '/item',
      icon: 'ion-ios-flower'
    },
    {
      text: 'Promo',
      path: '/promo',
      icon: 'ion-ios-briefcase'
    },
    {
      text: 'Users',
      path: '/users',
      icon: 'ion-ios-person'
    },
    {
      text: 'Logout',
      path: '/logout',
      icon: 'ion-ios-log-out'
    }
  ]

  return (
    <div className="App"> 
      <ResponsiveNavigation
        navLinks={ navLinks }
        logo={ logo }
      />
      <Router>
        <Home path="/home"/>
        <Transaction path="/transaction"/>
        <Packet path="/packet"/>
        <Service path="/service"/>
        <Item path="/item"/>
        <Promo path="/promo"/>
        <Users path="/users"/>
        <Logout path="/logout"/>
      </Router>
    </div>
  );
}

export default App;
