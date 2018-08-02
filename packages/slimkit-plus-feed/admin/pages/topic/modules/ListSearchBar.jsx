import React from 'react';
import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import Toolbar from '@material-ui/core/Toolbar';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import FormControl from '@material-ui/core/FormControl';
import Select from '@material-ui/core/Select';
import TextField from '@material-ui/core/TextField';
import Button from '@material-ui/core/Button';
import Collapse from '@material-ui/core/Collapse';

const styles = theme => ({
  root: {
    paddingTop: theme.spacing.unit * 3,
    marginBottom: theme.spacing.unit * 2
  },
  formControl: {
    margin: `0 ${theme.spacing.unit}px`,
    minWidth: 120,
    '&:first-child': {
      marginLeft: 0
    }
  },
  baseMargin: {
    margin: theme.spacing.unit
  },
  hidden: {
    display: 'none'
  }
});

class ListSearchBar extends React.Component {

  static propTypes = {
    classes: PropTypes.object.isRequired,
    show: PropTypes.bool.isRequired
  }

  state = {
    hot: 0,
    name: ''
  }

  handleChangeInput = event => {
    this.setState({ [event.target.name]: event.target.value });
  }

  handleResetSearch = () => {
    this.setState({
      name: '',
      hot: 0
    });
  }

  render() {
    let { classes, show } = this.props;

    return (
      <Collapse in={show}>
        <Toolbar className={classes.root}>
          <TextField
            name="name"
            value={this.state.name}
            className={classes.formControl}
            label="名称"
            placeholder="输入名称关键词..."
            onChange={this.handleChangeInput}
          />
          <FormControl className={classes.formControl}>
            <InputLabel>热门</InputLabel>
            <Select
              value={this.state.hot}
              onChange={this.handleChangeInput}
              name="hot"
            >
              <MenuItem value={0}>否</MenuItem>
              <MenuItem value={1}>是</MenuItem>
            </Select>
          </FormControl>
          <Button className={classes.baseMargin} variant="contained" color="primary">搜&nbsp;索</Button>
          <Button className={classes.baseMargin} variant="contained" onClick={this.handleResetSearch}>重&nbsp;置</Button>
        </Toolbar>
      </Collapse>
    );
  }
}

export default withStyles(styles)(ListSearchBar);
