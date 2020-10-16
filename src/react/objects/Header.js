import React from 'react';

export default function Header() {

    return(
        <div className="o-header">
            <div className="grid-container">
                <div class="grid-x">
                    <div className="cell o-header__logo">
                        <a href="http://google.com">
                            <img src={'/wp-content/themes/grubs-up/src/images/logo.svg'}/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    )
}