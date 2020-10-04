import React, {Component} from 'react';
import Grid from '@material-ui/core/Grid';
import axios from 'axios';

import Header from '../objects/Header';
import CuisineCard from '../components/CuisineCard';
import RestaurantCard from '../components/RestaurantCard';

export default class Listing extends Component {

    constructor(props){
        super(props);
        this.state = {
            restaurants : [],
            cuisines : []
        }
    }

    componentDidMount() {

        const apiBaseURL = 'http://grubsup.local/api/consumer';
        const restaurantEndpoint = '/restaurants';
        const cuisineEndpoint = '/cuisines';
        const postcodeQuery =   this.props.match.params.postcode ? `?postcode=${this.props.match.params.postcode}` : '';

        axios.all([
            axios.get(apiBaseURL + restaurantEndpoint + postcodeQuery)
                .then(res => {
                    const restaurants = res.data;
                    this.setState({ restaurants });
                })
            ,
            axios.get(apiBaseURL + cuisineEndpoint)
                .then(res => {
                    const cuisines = res.data;
                    this.setState({ cuisines });
                })
        ])
    }

    render() {

        const {restaurants, cuisines} = this.state; 

        return (
            <Grid container spacing={3}>

                <Grid item xs={12} container>

                        <Grid item xs={0} sm={1}/>
                        
                        <Grid item xs={12} sm={10} container spacing={3}>

                            <Grid item xs={12} md={3}>
                                <div class="o-listings__cuisine-list">
                                    <div className="o-listings__cuisine-list__header">
                                        <h3>Cuisines</h3>
                                    </div>
                                    <Grid container spacing={1}>
                                        { cuisines.map( cuisine => <CuisineCard cuisine={cuisine}/>)}
                                    </Grid>
                                </div>
                            </Grid>

                            <Grid item xs={12} md={9}>
                                <div className="restaurant-list-container"> 
                                    <div className="o-listings__restaurant-list__header">
                                        <h3>Currently open ({restaurants.length})</h3>
                                    </div>
                                    <ul className="o-listings__restaurant-list__restaurants">{restaurants.map( restaurant => <RestaurantCard restaurant={restaurant}/>) }</ul>
                                </div>

                                <div className="restaurant-list-container"> 
                                    <div className="o-listings__restaurant-list__header o-listings__restaurant-list__header--closed">
                                        <h3>Currently closed ({restaurants.length})</h3>
                                    </div>
                                    {/* <ul className="o-listings__restaurant-list__restaurants">{restaurants.map( restaurant => <RestaurantCard restaurant={restaurant}/>) }</ul> */}
                                </div>
                            </Grid>
                        </Grid>

                        <Grid item xs={0} sm={1}/>
                </Grid>
            </Grid>
        )
    }
}