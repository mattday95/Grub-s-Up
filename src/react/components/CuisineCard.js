import React from 'react';
import Grid from '@material-ui/core/Grid';

export default function CuisineCard(props) {

    return(
        <Grid item xs={6} sm={3} md={6}>
            <div class="c-cuisine-card">
                <div className="c-cuisine-card__thumbnail">
                    <img src={props.cuisine.featured_image}/>
                </div>
                <div className="c-cuisine-card__description">
                    <span>{props.cuisine.cuisine.name} ({props.cuisine.cuisine.count})</span>
                </div>
            </div>
        </Grid>
    )

}