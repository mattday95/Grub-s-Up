import React from 'react';
import {Link} from 'react-router-dom';
import StarRatings from 'react-star-ratings';
import { BiShoppingBag } from 'react-icons/bi';
import { MdLocationOn } from 'react-icons/md';
import { RiEBikeFill } from 'react-icons/ri';
import Skeleton from 'react-loading-skeleton';
import DiscountTag from './DiscountTag';

export default function RestaurantCard(props) {

    const cuisineList = props.restaurant.cuisines ? props.restaurant.cuisines.map( cuisine => <li>{cuisine.name}</li>) : '';
    let ctaLabel = '';

    switch(props.cta) {
        case 'order':
            ctaLabel = 'Order Now';
            break;
        case 'preorder':
            ctaLabel = 'Pre Order';
            break;
        case 'closed':
            ctaLabel = 'Closed';
            break;
    }

    return (

        <li className="c-restaurant-card">
            <Link to={{pathname : `/ordernow/${props.restaurant.slug}/${props.restaurant.id}`, state: props.restaurant}}>
                <div className="c-restaurant-card__thumbnail">
                    <img src={props.restaurant.logo ? props.restaurant.logo : '/wp-content/themes/grubs-up/src/images/placeholder.png'}/> 
                </div>
                <div className="c-restaurant-card__info">
                    <div className="c-restaurant-card__info__header">
                        <h2>{props.restaurant.name}</h2>
                        { 
                            props.restaurant.discount.rate > 0 &&
                            <DiscountTag style="stacked" minimum_spend={props.restaurant.discount.minimum_spend} rate={props.restaurant.discount.rate}/>
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
                            props.restaurant.times.collection && props.restaurant.collection_available &&
                            <div class="c-restaurant-card__info__meta__field">
                                <BiShoppingBag/>
                                <span>{props.restaurant.times.collection} mins</span>
                            </div>
                        }
                        {
                            props.restaurant.times.delivery && props.restaurant.delivery_available &&
                            <div class="c-restaurant-card__info__meta__field">
                                <RiEBikeFill/>
                                <span>{props.restaurant.times.delivery} mins</span>
                            </div>
                        }
                         {
                            props.restaurant.delivery.charge && props.restaurant.delivery_available &&
                            <div class="c-restaurant-card__info__meta__field">
                                <span className={`delivery-charge ${parseInt(props.restaurant.delivery.charge) == 0 ? 'delivery-charge-free' : ''}`}>{parseInt(props.restaurant.delivery.charge) > 0 ? `Delivery: £${props.restaurant.delivery.charge}` : 'Delivery Free'}</span>
                                {
                                    parseInt(props.restaurant.delivery.minimum_spend) > 0 &&
                                    <span className="minimum-spend">(min order: £{props.restaurant.delivery.minimum_spend})</span>
                                }
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
                    <button className={`c-button c-button--${props.cta}`}>{ctaLabel}</button>
                </div>
            </Link>
        </li>

    )
}