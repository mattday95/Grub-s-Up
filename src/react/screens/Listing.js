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
            restaurantSort : 'near-me',
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

    filterRestaurantsByActiveCategories( restaurants ) {

        const {activeCategories} = this.state;

        const filteredRestaurants = restaurants.filter(restaurant => {
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

        return filteredRestaurants;
    }

    getUniqueCuisines() {

        const {cuisineData} = this.state;

        const uniqueCuisines = cuisineData.reduce((acc, current) => {
            const x = acc.find(item => item.id === current.id);
            if (!x) {
              return acc.concat([current]);
            } else {
              return acc;
            }
        }, []);

        return uniqueCuisines;
    }

    sortRestaurantsByDistance(restaurants) {

        return restaurants.sort( (a, b) => {

            if(a.distance < b.distance){
                return -1;
            }else if(a.distance > b.distance){
                return 1;
            }else{
                return 0;
            }

        });
    }


    sortRestaurantsByRating(restaurants) {

        return restaurants.sort( (a, b) => {

            if(a.reviews.average_rating > b.reviews.average_rating){
                return -1;
            }else if(a.reviews.average_rating < b.reviews.average_rating){
                return 1;
            }else{
                return 0;
            }

        });
    }

    sortRestaurantsByDiscount(restaurants) {

        return restaurants.sort( (a, b) => {

            if(parseInt(a.discount.rate) > parseInt(b.discount.rate)){
                return -1;
            }else if(parseInt(a.discount.rate) < parseInt(b.discount.rate)){
                return 1;
            }else{
                return 0;
            }

        });
    }

    sortRestaurantsByAlphabet(restaurants) {

        return restaurants.sort( (a, b) => {

            if( a.name < b.name){
                return -1;
            }else if(a.name > b.name){
                return 1;
            }else{
                return 0;
            }

        });

    }

    shuffleRestaurants( array ) {
        var currentIndex = array.length, temporaryValue, randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {

            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

    render() {

        const {allRestaurants, activeCategories, restaurantSearch, restaurantSort} = this.state; 
        const uniqueCuisines = this.getUniqueCuisines();
        let visibleRestaurants = allRestaurants;

        switch(restaurantSort) {
            case 'near-me':
                visibleRestaurants = this.sortRestaurantsByDistance(visibleRestaurants);
                break;
            case 'rating':
                visibleRestaurants = this.sortRestaurantsByRating(visibleRestaurants);
                break;
            case 'discount':
                visibleRestaurants = this.sortRestaurantsByDiscount(visibleRestaurants);
                break;
            case 'a-z':
                visibleRestaurants = this.sortRestaurantsByAlphabet(visibleRestaurants);
                break;
            case 'random':
                visibleRestaurants = this.shuffleRestaurants(visibleRestaurants);
                break;
        }

        if(activeCategories.length > 0){
            visibleRestaurants = this.filterRestaurantsByActiveCategories(visibleRestaurants);
        }

        if(restaurantSearch !== null){
            visibleRestaurants = visibleRestaurants.filter(restaurant => restaurant.name.toLowerCase().includes(restaurantSearch.toLowerCase()));
        }
        
        const openRestaurants = visibleRestaurants.filter( restaurant => restaurant.is_open);
        const closedRestaurants = visibleRestaurants.filter( restaurant => !restaurant.is_open);
        

        return (

            <div>

            <Header/>
                     
            <div className="grid-container o-listings">

                <div className="grid-x grid-margin-x">
                    <div className="cell small-12 medium-3">
                        <div class="o-listings__cuisine-list">
                            <div className="o-listings__cuisine-list__header">
                                <h3>Cuisines</h3>
                                <span onClick={()=> this.setState({activeCategories : []})}>Reset</span>
                            </div>
                            <div className="grid-x">
                                { uniqueCuisines.map( cuisine => <CuisineCard isActive={activeCategories.includes(cuisine.id)} clickHandler={(id)=> this.changeActiveCategories(id)} key={cuisine.id} count={this.getCuisineCount(cuisine.id)} cuisine={cuisine}/>)}
                            </div>
                        </div>
                    </div>

                    <div className="cell small-12 medium-9">
                        <div className="o-restaurant-filter">
                            <div className="c-search o-restaurant-filter__search">
                                <input onChange={(e) => this.setState({ restaurantSearch : e.target.value})} type="text" placeholder="Search Takeaways"/>
                                <BsSearch size='14px'/>
                            </div>
                            <div class="o-restaurant-filter__sort">
                                <span>Sort by</span>
                                <select onChange={(e) => this.setState({restaurantSort : e.target.value})} value={this.state.restaurantSort} name="restaurant-sort">
                                    <option value="random">Random</option>
                                    <option value="a-z">A-Z</option>
                                    <option value="discount">Discount</option>
                                    <option value="near-me">Near Me</option>
                                    <option value="rating">Rating</option>
                                </select>
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