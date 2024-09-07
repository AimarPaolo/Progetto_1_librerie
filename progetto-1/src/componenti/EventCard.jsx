import React from 'react';
import TicketCounter from './TicketCounter';

const EventCard = ({ event, onIncrement, onDecrement }) => {
  const { id, name, image, description, cost, date, time, totalTickets } = event;

  return (
    <div className="evento">
      <h2>{name}</h2>
      <img src={image} alt={`${name}, caricamento immagine`} />
      <span className="descrizione">{description}</span>
      <TicketCounter 
        totalTickets={totalTickets} 
        cost={cost} 
        onIncrement={() => onIncrement(id)} 
        onDecrement={() => onDecrement(id)} 
      />
      <time className="scadenza">{`Data concerto: ${date} ore: ${time}`}</time>
    </div>
  );
};

export default EventCard;