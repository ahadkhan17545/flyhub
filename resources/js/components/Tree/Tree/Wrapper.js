import * as React from 'react';

const Wrapper = props => {
    return (
        <div className="T-wrapper" style={{ paddingLeft: 20 * props.level }}>
            {props.children}
        </div>
    );
};

Wrapper.defaultProps = {
    level: 0,
};

export default Wrapper;
