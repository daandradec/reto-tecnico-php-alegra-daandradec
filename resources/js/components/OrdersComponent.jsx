/* IMPORTACIONES DE REACT */
import React from 'react'

/* COMPONENTE CON EL LISTADO DE LAS ORDENES */
function OrdersComponent({ orders, current, setCurrent }) {

    /* FUNCION PARA SETTEAR LA ORDEN ACTUAL SELECCIONADA */
    const prepareOrder = (order) => () => {
        setCurrent(order)
    }

    return (
        <>
            {/* TITULAR DEL COMPONENTE */}
            <h3 className="text-center">
                Orders
            </h3>

            {/* SI HAY ORDENES MUESTRELAS, SINO ENTONCES MUESTRE UN MENSAJE DE QUE NO HAY */
                orders.length > 0 ? (
                    <div className="orders mb-5 position-relative">
                        
                        {/* COMPONENTE DE BLOQUEO DE EVENTOS SOBRE LAS ORDENES SI HAY UNA ORDEN SELECCIONADA */
                            !!current ? (
                                <div className='position-absolute top-0 left-0 w-100 h-100 z-20 bg-white bg-opacity-50'></div>
                            ) : null
                        }
                        {/* LISTADO DE ORDENES QUE SE PUEDEN CLICKEAR PARA SELECCIONARLA A COCINAR */
                            orders.map(order => (
                                <div key={order.id} className={`order-card ${current?.id == order.id && "bg-green-soft"}`}>
                                    <img src={order.food.food_path_img} alt="foto" width="100px" />
                                    <div className="order-text">
                                        <h3>{order.id}</h3>
                                        <p>{order.food.food_name}</p>
                                    </div>
                                    <button className="order-button" onClick={prepareOrder(order)} disabled={!!current && current.id != order.id}>Cook</button>
                                </div>
                            ))
                        }
                    </div>
                ) : <p className='text-center mb-5'>There are no orders at the moment, please create one in the Home</p>
            }

        </>
    )
}

export default OrdersComponent