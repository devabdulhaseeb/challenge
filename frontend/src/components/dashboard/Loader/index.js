import Loader from "react-js-loader";
import React from 'react';

function LoaderComponent() {
return (
    <div className="App">
         <div className={"item"}>
                <Loader type="hourglass" bgColor={"#1909B3"} title={"Loading.. Please Wait"} color={'#1909B3'} size={100} />
            </div>
      
    </div>
);
}
export default LoaderComponent;