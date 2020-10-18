import React from 'react';
import StarRatings from 'react-star-ratings';
import { BiShoppingBag } from 'react-icons/bi';
import { MdLocationOn } from 'react-icons/md';
import { RiEBikeFill } from 'react-icons/ri';
import Skeleton from 'react-loading-skeleton';

export default function RestaurantCard(props) {

    const cuisineList = props.restaurant.cuisines ? props.restaurant.cuisines.map( cuisine => <li>{cuisine.name}</li>) : '';

    return (

        <li className="c-restaurant-card">
            <a href={props.restaurant.link}>
                <div className="c-restaurant-card__thumbnail">
                    <img src={props.restaurant.logo ? props.restaurant.logo : '/wp-content/themes/grubs-up/src/images/placeholder.png'}/>
                </div>
                <div className="c-restaurant-card__info">
                    <div className="c-restaurant-card__info__header">
                        <h2>{props.restaurant.name || <Skeleton count={5}/>}</h2>
                        { 
                            props.restaurant.discount.rate > 0 &&
                        
                            <div className="c-discount-tag">
                                <span className="c-discount-tag__tag">{props.restaurant.discount.rate}% off</span>
                                {
                                    props.restaurant.discount.minimum_spend !== false &&
                                    <span className="c-discount-tag__description">Min: £{props.restaurant.discount.minimum_spend}</span>
                                }
                            </div>
                
                        }
                    </div>
                    <ul className="c-restaurant-card__info__cuisines">
                        {cuisineList}
                    </ul>
                    <div className="c-restaurant-card__info__meta">
                        <div class="c-restaurant-card__info__meta__field">
                            <MdLocationOn/>
                            <span>{props.restaurant.distance} miles</span>
                        </div>
                        {
                            props.restaurant.times.collection &&
                            <div class="c-restaurant-card__info__meta__field">
                                <BiShoppingBag/>
                                <span>{props.restaurant.times.collection} mins</span>
                            </div>
                        }
                        {
                            props.restaurant.times.delivery &&
                            <div class="c-restaurant-card__info__meta__field">
                                <RiEBikeFill/>
                                <span>{props.restaurant.times.delivery} mins</span>
                            </div>
                        }
                    </div>
                </div>
                <div className="c-restaurant-card__ratings">
                    <StarRatings
                        rating={props.restaurant.reviews.average_rating}
                        starRatedColor="#d82927"
                        numberOfStars={5}
                        starDimension="17px"
                        starSpacing="2px"
                        name='rating'
                    />
                    <span>{`${props.restaurant.reviews.num_reviews} ${props.restaurant.reviews.num_reviews > 1 || props.restaurant.reviews.num_reviews === 0 ? 'Reviews' : 'Review'}`}</span>
                    <button className="c-button c-button--order">Order Now</button>
                </div>
            </a>
        </li>

    )
}