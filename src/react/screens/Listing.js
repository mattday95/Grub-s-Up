import React, {Component} from 'react';
import axios from 'axios';
import {BsSearch} from 'react-icons/bs';

import Header from '../objects/Header';
import CuisineCard from '../components/CuisineCard';
import RestaurantCard from '../components/RestaurantCard';

export default class Listing extends Component {

    constructor(props){
        super(props);
        this.state = {
            allRestaurants : [],
            showRestaurants : [],
            cuisineData : [],
            restaurantSearch : null,
            activeCategories : []
        }
    }

    componentDidMount() {

        const apiBaseURL = 'http://grubsup.local/api/consumer';
        const restaurantEndpoint = '/restaurants';
        const postcodeQuery =   this.props.match.params.postcode ? `?postcode=${this.props.match.params.postcode}` : '';

        axios.get(apiBaseURL + restaurantEndpoint + postcodeQuery)
            .then(res => {
                const restaurants = res.data;
                this.setState({ 
                    allRestaurants : restaurants, 
                    showRestaurants : restaurants,
                    cuisineData : this.getCuisinesFromRestaurants(restaurants) 
                });
            });

    }

    getCuisinesFromRestaurants( restaurants ) {

        let cuisineData = [];

        restaurants.forEach(restaurant => cuisineData.push(restaurant.cuisines));

        cuisineData =  [].concat.apply([], cuisineData);
        
        return cuisineData;
    }

    getCuisineCount(id) {

        const cuisineData = this.state.cuisineData;
        let count = 0;

        cuisineData.forEach( entry => {
            if(entry.id === id){
                count++;
            }
        });

        return count;
    }

    changeActiveCategories(id) {

        let currentActiveCategories = this.state.activeCategories.slice();

        if( !currentActiveCategories.includes(id) ){
            currentActiveCategories.push(id);
        }

        else {
            const index = currentActiveCategories.indexOf(id);
            if (index > -1) {
                currentActiveCategories.splice(index, 1);
            }
        }

        //console.log(currentActiveCategories);
        this.setState({activeCategories: currentActiveCategories});
    }

    render() {

        console.log(this.state.restaurantSearch);
        const {allRestaurants, cuisineData, activeCategories, restaurantSearch} = this.state; 
        let showRestaurants = allRestaurants;

        if(activeCategories.length > 0){
            showRestaurants = allRestaurants.filter(restaurant => {
                const cuisines = restaurant.cuisines;
                let categoryExists = false;
                activeCategories.forEach(category => {
                    cuisines.forEach((cuisine) => {
                        if(cuisine.id === category){
                            categoryExists = true;
                        }
                    });
                });
                return categoryExists;
            });
        }

        if(restaurantSearch !== null){
            showRestaurants = showRestaurants.filter(restaurant => restaurant.name.toLowerCase().includes(restaurantSearch.toLowerCase()));
        }
        
        const openRestaurants = showRestaurants.filter( restaurant => restaurant.is_open);
        const closedRestaurants = showRestaurants.filter( restaurant => !restaurant.is_open);
        
        const uniqueCuisines = cuisineData.reduce((acc, current) => {
            const x = acc.find(item => item.id === current.id);
            if (!x) {
              return acc.concat([current]);
            } else {
              return acc;
            }
          }, []);

        return (

            <div>

            <Header/>
                     
            <div className="grid-container o-listings">

                <div className="grid-x grid-margin-x">
                    <div className="cell small-12 medium-4">
                        <div class="o-listings__cuisine-list">
                            <div className="o-listings__cuisine-list__header">
                                <h3>Cuisines</h3>
                                <span onClick={()=> this.setState({activeCategories : []})}>Reset</span>
                            </div>
                            <div className="grid-x grid-margin-x">
                                { uniqueCuisines.map( cuisine => <CuisineCard isActive={activeCategories.includes(cuisine.id)} clickHandler={(id)=> this.changeActiveCategories(id)} key={cuisine.id} count={this.getCuisineCount(cuisine.id)} cuisine={cuisine}/>)}
                            </div>
                        </div>
                    </div>

                    <div className="cell small-12 medium-8">
                        <div className="o-restaurant-filter">
                            <div class="c-search">
                                <input onChange={(e) => this.setState({ restaurantSearch : e.target.value})} type="text" placeholder="Search Takeaways"/>
                                <BsSearch/>
                            </div>
                        </div>
                        <div className="restaurant-list-container"> 
                            <div className="o-listings__restaurant-list__header">
                                <h3>Currently open ({openRestaurants.length})</h3>
                            </div>
                            <ul className="o-listings__restaurant-list__restaurants">{openRestaurants.map( restaurant => <RestaurantCard key={restaurant.id} restaurant={restaurant}/>) }</ul>
                        </div>

                        <div className="restaurant-list-container"> 
                            <div className="o-listings__restaurant-list__header o-listings__restaurant-list__header--closed">
                                <h3>Currently closed ({closedRestaurants.length})</h3>
                            </div>
                            <ul className="o-listings__restaurant-list__restaurants">{closedRestaurants.map( restaurant => <RestaurantCard key={restaurant.id} restaurant={restaurant}/>) }</ul>
                        </div>
                    </div>
                </div>

            </div>

            </div>

        )
    }
}