import React from 'react';
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
                    <img src={props.restaurant.logo}/>
                </div>
                <div className="c-restaurant-card__info">
                    <div className="c-restaurant-card__info__header">
                        <h2>{props.restaurant.name || <Skeleton count={5}/>}</h2>
                        { 
                            props.restaurant.discount !== false &&
                        
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

                </div>
            </a>
        </li>

    )
}