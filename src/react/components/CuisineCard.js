import React from 'react';

export default function CuisineCard(props) {

    return(
        <div className="cell small-6">
            <div class="c-cuisine-card">
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