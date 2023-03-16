import React from 'react'
import ReactDOM from 'react-dom'

export default class Index extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      results: this.props.results,
      test: this.props.test,
    }
  }

  render() {

    return (
      <div>
      <table className="table table-bordered test-table mb-5">
        <thead>
          <tr>
            <th scope="col" width="10%">Номер<br />вопроса</th>
            <th scope="col" width="40%">Вопрос</th>
            <th scope="col" width="25%">Ваш ответ</th>
            <th scope="col" width="25%">Ответ собеседника</th>
          </tr>
        </thead>
        <tbody>
          {this.state.results.map((index, key) => (
            <tr key={key}>
              <th scope="row">{index.name}</th>
              <td>{index.questionName}</td>
              <td>{index.firstUser}</td>
              <td>{index.secondUser}</td>
            </tr>
          ))}

        </tbody>
      </table>
      </div>
    )
  }
}
