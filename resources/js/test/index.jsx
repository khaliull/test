import React from 'react'
import ReactDOM from 'react-dom'
import Select from 'react-select'
import axios from 'axios';
import {
  CircularProgressbarWithChildren,
  buildStyles
} from "react-circular-progressbar";
import "react-circular-progressbar/dist/styles.css";
import ClipboardComponent from '../components/clipboard';


class QuestionCreate extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      test: window.test,
      questions: [],
      activeQuestion: null,
      answer: null,
      nextTwoQuestion: true,
      keyPairedTest: null,
      pairedTestKeyShow: window.pairedTestKeyShow
    }

    this.sendAnswer = this.sendAnswer.bind(this)
    this.closedTest = this.closedTest.bind(this)
    this.getLastAnswer = this.getLastAnswer.bind(this)

  }

  async componentDidMount() {

    const form = new FormData()

    form.append('pairedTestKeyShow', window.pairedTestKeyShow)


    let response

    response = await axios.post('/test/'+this.state.test.key+'/get-questions/', form)

    this.setState({questions: response.data.questions, activeQuestion: response.data.nextQuestion, nextTwoQuestion: response.data.nextTwoQuestion, keyPairedTest: response.data.keyPairedTest})
  }



  async sendAnswer() {

    if (!this.state.answer) {
      return
    }
    const form = new FormData()

    form.append('answer', this.state.answer)
    form.append('question_id', this.state.activeQuestion.id)

    let response

    try {

      response = await axios.post('/test/' + this.state.test.key + '/send-question', form)

    } catch(error) {

      alert('Произошла ошибка, попробуйте еще раз')

      return
    }

    if (!response.data.nextQuestion) {
      return this.closedTest()
    }

    let inputs = document.querySelectorAll("input[name='radio']");

    inputs.forEach((item, i) => {
      item.checked = false
    });

    this.setState({activeQuestion: response.data.nextQuestion, answer: response.data.answer, nextTwoQuestion: response.data.nextTwoQuestion})



  }

  async closedTest() {

    let response

    const form = new FormData()

    form.append('pairedTestKeyShow', this.state.pairedTestKeyShow)

    try {

      response = await axios.post('/test/' + this.state.test.key + '/complete-test', form)

    } catch(error) {

      alert('Произошла ошибка, попробуйте еще раз')

      return
    }

    window.location.href = '/test/' + this.state.test.key + '/results/' + response.data
  }

  async getLastAnswer() {

    let response

    try {

      response = await axios.get('/test/' + this.state.test.key + '/last-question/' + this.state.activeQuestion.id)

    } catch(error) {

      alert('Произошла ошибка, попробуйте еще раз')

      return
    }
    this.setState({activeQuestion: response.data.question, answer: response.data.lastAnswer.answer, nextTwoQuestion: true})
  }

  render() {

    return (
      <div>
      {this.state.questions.length && (
      <div>
        <div className="d-flex justify-content-between align-items-center">
          <div>
            <h4 className="mb-0 pe-3">{this.state.test.name}</h4>
          </div>
          <div>
            {this.state.keyPairedTest && (
              <ClipboardComponent testKey={this.state.test.key} keyPairedTest={this.state.keyPairedTest} />
            )}
          </div>
        </div>
      <div className="test-card-questions mb-4 pt-4">
        {this.state.activeQuestion && this.state.activeQuestion.type == 'selectRadio' ? (
          <div>
          <div className="text-center mb-4">
            <CircularProgressbarWithChildren
              value={this.state.activeQuestion.position / this.state.questions.length * 100}
              text={`${this.state.activeQuestion.position} / ${this.state.questions.length}`}
              strokeWidth={12}
              styles={buildStyles({
                textColor: "white",
                pathColor: '#ac78d0',
                trailColor: "#ffffff"
              })}
             className="circle"
            >
            </CircularProgressbarWithChildren>
          </div>
          <h3 className="text-center h2 mb-4">{this.state.activeQuestion.name}</h3>
          {this.state.activeQuestion.data.select.map((index, key) => (
            <div key={key} className="form-check">
              <input className="form-check-input" checked={this.state.answer == index} name={'radio'} type="radio" onChange={() => this.setState({answer: index})} id={'check'+key} />
              <label className="form-check-label" htmlFor={'check'+key}>
                <p className="test-card-questions-ladel">{index}</p>
              </label>
            </div>
          ))}
          </div>
        ) : null}
      </div>
      <div className="d-flex justify-content-between pt-5">
          <button disabled={this.state.activeQuestion && this.state.activeQuestion.position == 0} onClick={() => this.getLastAnswer()} className="btn test-btn fw-bold">Назад</button>
          <button disabled={!this.state.answer} className="btn test-btn fw-bold" onClick={() => this.sendAnswer()}>
          {this.state.nextTwoQuestion == true ? 'Следующий вопрос' : 'Завершить тест'}
          </button>
      </div>
      </div>
    )}

      </div>
    )
  }
}

const element = document.querySelector('.test-show')

if (element) {
  ReactDOM.render(<QuestionCreate />, element)
}
