/* IMPORTACIONES DE REACT */
import React, { useState } from 'react'

/* IMPORTACION DE LOS COMPONENTES DEL DASHBOARD */
import OrdersComponent from './OrdersComponent'
import StockComponent from './StockComponent'
import MenuComponent from './MenuComponent'
import HudComponent from './HudComponent'

/* COMPONENTE QUE DEFINE EL LAYOUT PARA EL DASHBOARD */
function GridDashboard(props) {   
    /* VARIABLE DE STATE CON LA ORDEN SELECCIONADA */
    const [current, setCurrent] = useState(null)

    return (
        <section className="container-fluid">
            <div className="row">

                {/* COMPONENTE DEL LISTADO DE ORDENES */}
                <div className="col-12 col-lg-6">
                    <OrdersComponent orders={props.state.orders} current={current} setCurrent={setCurrent}/>
                </div>


                <div className="col-12 col-lg-6">
                    {/* COMPONENTE DE PANTALLA DE HUD PARA VISUALIZACIÓN DE LOS LOGS DE LA APLICACIÓN */}
                    <div className="row mb-5 hud-wrapper">
                        <div className="hud-zone">
                            <HudComponent current={current} setCurrent={setCurrent} ingredients={props.state.ingredients_dict} updateOrder={props.updateOrder} buyStock={props.buyStock}/>
                        </div>
                    </div>                     

                    {/* COMPONENTES DE INVENTARIO Y EL MENU DE COMIDAS */}
                    <div className="row">
                        <div className="col-12 col-lg-4">
                            <StockComponent ingredients={props.state.ingredients} current={current}/>
                        </div>
                        <div className="col-12 col-lg-8">
                            <MenuComponent foods={props.state.foods}/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    )
}

export default GridDashboard