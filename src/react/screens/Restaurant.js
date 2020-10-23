import React, {Component} from 'react';
import {BsSearch} from 'react-icons/bs';

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
                <div className="o-hero-restaurant">
                    <div className="grid-container">
                        <div className="grid-x">
                            <div className="medium-2">
                                <div className="o-hero-restaurant__logo">
                                    <img src={restaurant.logo}/>
                                </div>
                            </div>
                            <div className="medium-7">
                                <div className="o-hero-restaurant__meta">

                                </div>
                            </div>
                            <div className="medium-3">

                            </div>
                        </div>
                    </div>
                </div>
                <div className="grid-container">
                    <div className="grid-x grid-margin-x u-align-x--top">
                        <div className="cell medium-3 o-category-list">
                            <h3>Items</h3>
                            <ul className="o-category-list__list">
                                <li><a href="#">Pizza</a></li>
                                <li><a href="#">Calzone</a></li>
                                <li><a href="#">Garlic Bread</a></li>
                                <li><a href="#">Kebabs</a></li>
                                <li><a href="#">Burgers</a></li>
                                <li><a href="#">Parmesans</a></li>
                                <li><a href="#">Wraps</a></li>
                                <li><a href="#">Sides</a></li>
                                <li><a href="#">Icecream</a></li>
                                <li><a href="#">Drinks</a></li>
                            </ul>
                        </div>
                        <div className="cell medium-5 o-product-list">
                            <div className="o-product-list__search">
                                <div className="c-search">
                                    <input onChange={(e) => this.setState({ restaurantSearch : e.target.value})} type="text" placeholder="Search Takeaways"/>
                                    <BsSearch size='14px'/>
                                </div>
                            </div>
                            <div className="c-product-group">
                                <div className="c-product-group__header">
                                    <span>Best Selling</span>
                                </div>
                                <div className="c-product-group__sub-cat">
                                    <div className="c-product-group__sub-cat__header">
                                        <span>Margherita Pizza</span>
                                        <p>Cheese and tomato</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <div className="c-product-list-item__details">
                                            <h4 className="product-title">Product Title</h4>
                                            <p className="product-description">4pcs strips, 5pcs bites, 15pcs popcorn chicken, 1 fries, coleslaw, garlic mayo and pepsi can</p>
                                        </div>
                                        <span className="c-product-list-item__price">£7.50</span>
                                        <div className="c-product-list-item__add-to-cart">
                                            <div className="c-add-to-cart">
                                                <span>Add</span>
                                                <span>+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="c-product-list-item">
                                        <div className="c-product-list-item__details">
                                            <h4 className="product-title">Product Title</h4>
                                            <p className="product-description">4pcs strips, 5pcs bites, 15pcs popcorn chicken, 1 fries, coleslaw, garlic mayo and pepsi can</p>
                                        </div>
                                        <span className="c-product-list-item__price">£7.50</span>
                                        <div className="c-product-list-item__add-to-cart">
                                            <div className="c-add-to-cart">
                                                <span>Add</span>
                                                <span>+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="c-product-list-item">
                                        <div className="c-product-list-item__details">
                                            <h4 className="product-title">Product Title</h4>
                                        </div>
                                        <span className="c-product-list-item__price">£7.50</span>
                                        <div className="c-product-list-item__add-to-cart">
                                            <div className="c-add-to-cart">
                                                <span>Add</span>
                                                <span>+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="c-product-group__sub-cat">
                                    <div className="c-product-group__sub-cat__header">
                                        <span>Margherita Pizza</span>
                                        <p>Cheese and tomato</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                </div>
                            </div> 
                            <div className="c-product-group">
                                <div className="c-product-group__header">
                                    <span>Pizzas</span>
                                </div>
                                <div className="c-product-group__sub-cat">
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                </div>
                            </div>  
                            <div className="c-product-group">
                                <div className="c-product-group__header">
                                    <span>Calzone</span>
                                </div>
                                <div className="c-product-group__sub-cat">
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                </div>
                                <div className="c-product-group__sub-cat">
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                </div>
                                <div className="c-product-group__sub-cat">
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                    <div className="c-product-list-item">
                                        <p>Hot Stuff Special Kebab on Naan</p>
                                    </div>
                                </div>
                            </div>   
                        </div>
                        <div className="cell medium-4 o-basket">
                            <h3>Basket</h3>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}