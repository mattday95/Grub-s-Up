import React from 'react';
import logo from '../../images/logo.svg';

export default function Header() {

    return(
        <div className="o-header">
            <div className="grid-container">
                <div class="grid-x">
                    <div className="cell o-header__logo">
                        <a href="http://google.com">
                            <img src={logo}/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    )
}