class CardsConstruct extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            films: props.filmsProps,
            dBtn: props.dBtn,
            session_id: props.session_id
        }
    }

    render() {
        return (
            <div className="cardsFrame">
                {
                    this.state.films.map((value, index) => {
                        return <Cards info={value} key={index} dBtn={this.state.dBtn} url={this.props.url} xhrUrl={this.props.xhrUrl} session_id={this.state.session_id}/>
                    })
                }
            </div>
        )
    }
}


function Cards(props) {
    function goToSingle(id_movie){
        location.href=props.url+"?id_movie="+id_movie
    }
    function insertPref(id_movie){
       fetch( props.xhrUrl+"?id_movie="+id_movie+"&id_user="+props.session_id).then(
        (response)=>response.text()).then(
            (result)=>{console.log(result)}) 
    }
    return <div className="cards">
        <img src={props.info.urlFilm} className="cardsImg" alt="" />
        <h3 className="cardsTitle">{props.info.title}</h3>
        <div className="cardsPlot">{props.info.plot}</div>
        <p className="cardsCast">{props.info.cast}</p>
        <p className="cardsGenre">{props.info.genre}</p>
        <p className="cardsAnnee">{props.info.annee}</p>
        <p className="cardsDirectors">{props.info.directors}</p>
        <div className="buttonFlex">
            {props.dBtn  ?  <button className="cardsInfo" onClick={()=>{goToSingle(props.info.id_movie)}}>More Info</button> : ""}
            <button className="cardsLike" onClick={()=>{insertPref(props.info.id_movie)}} >Like <i className="fa-regular fa-thumbs-up"></i> </button>
        </div>
    </div>
}


ReactDOM.render(
<CardsConstruct 
    filmsProps={films} 
    dBtn={dBtn}
    url={url}
    xhrUrl={xhrUrl}
    session_id={session_id}
></CardsConstruct>, document.getElementById('cardsFrame'));