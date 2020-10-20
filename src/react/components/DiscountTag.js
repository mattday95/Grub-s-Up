import React from 'react';


export default function DiscountTag(props) {

    return (
                        
        <div className={`c-discount-tag ${props.style === 'inline' ? 'c-discount-tag--inline' : ''}`}>
            <span className="c-discount-tag__tag">{props.rate}% off</span>
            {
                props.minimum_spend !== false &&
                <span className="c-discount-tag__description">Min: £{props.minimum_spend}</span>
            }
        </div>

    )
}