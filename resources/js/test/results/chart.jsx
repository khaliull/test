import React from 'react'
import ReactDOM from 'react-dom'
import { BarChart, Bar, Cell, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

export default class Chart extends React.Component {
  constructor(props) {
    super(props)

    this.state = {
      data: this.props.data,
    }
  }

  render() {

    return (
      <div>
        <ResponsiveContainer className="test-result-chart">
          <BarChart
            data={this.state.data}
            margin={{
              top: 5,
              right: 0,
              left: 0,
              bottom: 5,
            }}
          >
            <CartesianGrid strokeDasharray="3 3" />
            <XAxis dataKey="name" />
            <YAxis />
            <Tooltip />
            <Legend />
            <Bar dataKey="Верно ответили" fill="#84d88f" />
            <Bar dataKey="Не правильно ответили" fill="#d88484" />
          </BarChart>
        </ResponsiveContainer>
      </div>
    )
  }
}
