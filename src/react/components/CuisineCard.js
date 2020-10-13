import React from 'react';

export default function CuisineCard(props) {

    const {id} = props.cuisine;

    return(
        <div onClick={(e)=> props.clickHandler(id)} className="cell small-6">
            <div className={`c-cuisine-card ${props.isActive ? 'c-cuisine-card--active' : ''}`}>
                <div className="c-cuisine-card__thumbnail">
                    <img src={props.cuisine.featured_image}/>
                </div>
                <div className="c-cuisine-card__description">
                    <span>{props.cuisine.name} ({props.count})</span>
                </div>
            </div>
        </div>
    )

}