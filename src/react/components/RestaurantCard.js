import React from 'react';
import Skeleton from 'react-loading-skeleton';

export default function RestaurantCard(props) {

    const cuisineList = props.restaurant.cuisines ? props.restaurant.cuisines.map( cuisine => <li>{cuisine.name}</li>) : '';

    return (

        <li className="c-restaurant-card">
            <a href="#">
                <div className="c-restaurant-card__thumbnail">
                    <img src={props.restaurant.logo}/>
                </div>
                <div className="c-restaurant-card__info">
                    <div className="c-restaurant-card__info__header">
                        <h2>{props.restaurant.name || <Skeleton count={5}/>}</h2>
                        <div className="c-discount-tag">
                            <span className="c-discount-tag__tag">25% off</span>
                            <span className="c-discount-tag__description">Min: £20.00</span>
                        </div>
                    </div>
                    <ul className="c-restaurant-card__info__cuisines">
                        {cuisineList}
                    </ul>
                    <div className="c-restaurant-card__info__meta"></div>
                </div>
                <div className="c-restaurant-card__ratings">

                </div>
            </a>
        </li>

    )
}