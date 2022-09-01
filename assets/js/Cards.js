class CardsConstruct extends React.Component{
    constructor(props){
    super(props);
    this.state= {films:props.filmsProps}
    }

    render(){
        return(
        <div className="cardsFrame">
        {
            this.state.films.map((value,index)=>{
                return <Cards info={value} key={index}/>
            })
        }
        </div>  
    )
    }
}




function Cards(props){
  
    return <div className="cards">
            <img src={props.info.urlFilm} className="cardsImg" alt="" />
            <h3 className="cardsTitle">{props.info.title}</h3>
            <div className="cardsPlot">{props.info.plot}</div>
            <p className="cardsCast">{props.info.cast}</p>
            <p className="cardsGenre">{props.info.genre}</p>
            <p className="cardsAnnee">{props.info.annee}</p>
            <p className="cardsDirectors">{props.info.directors}</p>
            <button className="cardsLike">Like <i className="fa-regular fa-thumbs-up"></i> </button>
     </div>
    }
 

ReactDOM.render(<CardsConstruct filmsProps={films}></CardsConstruct>,document.getElementById('cardsFrame'));