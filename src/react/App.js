import React, {Component} from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link, BrowserRouter
  } from "react-router-dom";

import '../scss/style.scss';

import Header from './objects/Header';

import Listing from './screens/Listing';
import Home from './screens/Home';
import Restaurant from './screens/Restaurant';

export default class App extends Component {

    render() {

        return(
            <BrowserRouter>
                <Switch>
                    <Route path="/" exact component={Home}/>
                    <Route path="/list/:postcode/" component={Listing}/>
                    <Route path="/restaurant/:restaurant/" component={Restaurant}/>
                    <Route path="/" render={() => <div>404. Not found.</div>}/>
                </Switch>
            </BrowserRouter>
        )
    }
}