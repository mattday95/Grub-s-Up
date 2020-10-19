import React, {Component} from 'react';

import Header from '../objects/Header';

export default class Restaurant extends Component {

    constructor(props){
        super(props);
    }

    render() {

        const restaurant = this.props.location.state;
        console.log(restaurant);

        return(
            <div>
                <Header/>
                <h1>This is the restaurant page for {restaurant.name}</h1>
            </div>
        )
    }
}